<html lang="en">
<?php include_once('layout/header.php') ?>
<?php include_once('../permission_staff.php') ?>
<?php include_once('layout/aside.php') ?>
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
            exit();
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


<main role="main">
    <div class="offset-3">
        <section class="panel">
            <h2>Top-up</h2>
            <form method="post">
                <div class="full">
                    <label for="email">E-mail:</label>
                    <input type="text" name="email" value="<?= $customer['email'] ?>" disabled>

                    <label for="full_name">Full Name:</label>
                    <input type="text" name="full_name" value="<?= $customer['fullname'] ?>" disabled>


                    <label for="account_balance">Account Balance</label>
                    <input id="account_balance" type="text" value="<?= displayPrice($customer['credit_balance']) ?>" disabled>

                    <label for="amount">Amount</label>
                    <input id="amount" class="form-lg" name="amount" type="number" value="">

                    <div class="">
                        <small class="text-sm font-weight-bold text-success">Instant value : </small>
                        <button class="btn btn-sm btn-success">RM5.00</button>
                        <button class="btn btn-sm btn-warning">RM10.00</button>
                        <button class="btn btn-sm btn-danger">R15.00</button>
                        <button class="btn btn-sm btn-info">RM20.00</button>
                    </div>

                    <div>
                        <input class="btn btn-md btn-success " name="submit" type="submit" value="Submit" />
                    </div>

                </div>
            </form>
        </section>
    </div>
</main>

<?php include_once('layout/footer.php') ?>
</html>