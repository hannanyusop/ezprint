<html lang="en">
<?php include_once('layout/header.php') ?>
<?php include_once('../permission_staff.php') ?>
<?php

    if(isset($_GET['id'])){

        $customer_q = $db->query("SELECT *,users.id as user_id FROM users LEFT JOIN accounts ON users.id=accounts.user_id WHERE users.id=$_GET[id] AND role_id=3");
        $customer = $customer_q->fetch_assoc();


        #if customer data not exist
        if(!$customer_q){
            echo "<script>alert('Customer data not found!');window.location='customer-list.php'</script>";
        }

        if(isset($_POST['submit'])){

            if($_POST['amount'] <= 0){
                echo "<script>alert('Please insert valid amount!');window.location='customer-topup.php?id=".$_GET['id']."'</script>";
            }

            $amount = (float)$_POST['amount'];

            $credit_balance = $customer['credit_balance']+$amount;
            $credit_total = $customer['credit_total']+$amount;

            if (!$db->query("UPDATE accounts SET credit_balance = $credit_balance, credit_total = $credit_total WHERE id=$customer[id]")) {
                echo "Error: Inserting updating credit balance." . $db->error; exit();
            }else{

                $credit_transaction = "INSERT INTO credit_transaction (account_id, job_id, staff_id, type, amount, current_balance, created_at) VALUES ($customer[id], 0, $user[id], 1, $amount, $credit_balance, CURRENT_TIMESTAMP)";
                if (!$db->query($credit_transaction)) {
                    echo "Error: " . $credit_transaction . "<br>" . $db->error; exit();
                }

                echo "<script>alert('Customer account charged!');</script>";
            }

        }
    }else{
        echo "<script>alert('Invalid action!');window.location='customer-list.php';window.location='customer-list.php'</script>";
    }
//    var_dump($result);exit();
?>
<body>
<div id="layout">
    <?php include_once('layout/aside.php'); ?>
    <div id="main">
        <div class="header">
            <h1>Add Customer</h1>
        </div>


        <div class="content">
            <div>
                <h5>*Note:</h5>

                <form class="pure-form pure-form-aligned" method="post">
                    <fieldset>
                        <div class="pure-control-group">
                            <label for="name">E-mail</label>
                            <input id="email" value="<?= $customer['email'] ?>" readonly>
                        </div>

                        <div class="pure-control-group">
                            <label for="full_name">Full Name</label>
                            <input type="text" value="<?= $customer['fullname'] ?>"" required>
                        </div>

                        <div class="pure-control-group">
                            <label for="account_balance">Account Balance</label>
                            <input id="account_balance" type="text" value="<?= displayPrice($customer['credit_balance']) ?>" readonly>
                        </div>

                        <div class="pure-control-group">
                            <label for="amount">Amount</label>
                            <input id="amount" name="amount" type="number" value="">
                        </div>

                        <div class="pure-controls">
                            <button type="submit" name="submit" class="pure-button pure-button-primary">Submit</button>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include_once('layout/footer.php'); ?>
</body>
</html>
