<?php include_once('../permission_customer.php') ?>
<?php

    $user_id = $_SESSION['auth']['user_id'];
    $job = $_SESSION['jobs'][$user_id];

    #inserting job
    $job_sql = "INSERT INTO jobs (customer_id, staff_id, file, status, total_price, pickup_date, created_at) VALUES ($user_id , 0, '$job[file]', 1, $job[subtotal],  CURRENT_TIMESTAMP , CURRENT_TIMESTAMP)";

    if (!$db->query($job_sql)) {
        echo "Error: " . $job_sql . "<br>" . $db->error; exit();
    }

    $job_id = (int)$db->insert_id;

    #inserting job's add on
    foreach ($job['addOn'] as $add_on){
        #insert data to database;
        $add_on_sql = "INSERT INTO jobs_has_add_on(job_id, add_on_id, price) VALUES ($job_id, $add_on[id], $add_on[price])";

        if (!$db->query($add_on_sql)) {
            echo "Error: " . $add_on_sql . "<br>" . $db->error; exit();
        }
    }


    #deduct from credit account;
    $credit_balance = $user['credit_balance']-$_SESSION['jobs'][$user_id]['subtotal'];

    $update_account = "UPDATE accounts SET credit_balance=$credit_balance WHERE user_id = $user_id";

    if (!$db->query($update_account)) {
        echo "Error: " . $update_account . "<br>" . $db->error; exit();
    }

    #insert to credit transaction
    #type = 2  (payment)
    $credit_transaction = "INSERT INTO credit_transaction (account_id, job_id, staff_id, type, amount, current_balance, created_at) VALUES ($user[account_id], $job_id, 1, 2, $job[subtotal], $credit_balance, CURRENT_TIMESTAMP)";
    if (!$db->query($credit_transaction)) {
        echo "Error: " . $credit_transaction . "<br>" . $db->error; exit();
    }

    #all query successfully executed without error;
    echo "<script>alert('Job successfully created!');window.location='dashboard.php'</script>";
?>