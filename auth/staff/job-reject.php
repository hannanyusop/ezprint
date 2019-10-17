<?php
    include_once('../permission_staff.php');

    if(isset($_GET['id'])){

        $result = $db->query("SELECT * FROM jobs WHERE id=$_GET[id] AND status=1");

        $job = $result->fetch_assoc();

        if(!$job){
            echo "<script>alert('Job not found!');window.location='dashboard.php'</script>";
        }

        #customer details
        $customer_sql = $db->query("SELECT *,accounts.id as account_id,users.id as customer_id FROM users LEFT JOIN accounts ON users.id = accounts.user_id WHERE users.id=$job[customer_id]");
        $customer = $customer_sql->fetch_assoc();

        #update job status
        $update_job ="UPDATE jobs SET status=4, staff_id=$user_id WHERE id=$job[id]";

        if (!$db->query($update_job)) {
            echo "Error: " . $update_job . "<br>" . $db->error; exit();
        }

        #refund money
        $credit_balance = $customer['credit_balance']+$job['total_price'];


        $update_account = "UPDATE accounts SET credit_balance=$credit_balance WHERE user_id = $customer[customer_id]";

        if (!$db->query($update_account)) {
            echo "Error: " . $update_account . "<br>" . $db->error; exit();
        }

        #insert to credit transaction
        #type = 2  (payment)
        $credit_transaction = "INSERT INTO credit_transaction (account_id, job_id, staff_id, type, amount, current_balance, created_at) VALUES ($customer[account_id], $job[id], $user_id, 3, $job[total_price], $credit_balance, CURRENT_TIMESTAMP)";
        if (!$db->query($credit_transaction)) {
            echo "Error: " . $credit_transaction . "<br>" . $db->error; exit();
        }

        echo "<script>alert('Successfully rejected!');window.location='dashboard.php'</script>";
    }else{
        echo "<script>alert('Invalid action!');window.location='dashboard.php'</script>";
    }
?>