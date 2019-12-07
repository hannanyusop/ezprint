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
                <div class="content">

                    <div class="form-group">
                        <label for="email">E-mail:</label>
                        <input type="text" name="email" value="<?= $customer['email'] ?>" disabled>
                    </div>

                    <div class="form-group">
                        <label for="full_name">Full Name:</label>
                        <input type="text" name="full_name" value="<?= $customer['fullname'] ?>" disabled>
                    </div>


                    <div class="form-group">
                        <label for="account_balance">Account Balance</label>
                        <input id="account_balance" type="text" value="<?= displayPrice($customer['credit_balance']) ?>" disabled>
                    </div>

                   <div class="form-group">
                       <label for="amount">Amount</label>
                       <input id="amount" class="form-lg" name="amount" type="number" value="">
                   </div>

                    <div class="">
                        <small class="text-sm font-weight-bold text-success">Instant value : </small>
                        <a class="btn btn-sm btn-success instant" data-value="5.00">RM5.00</a>
                        <a class="btn btn-sm btn-warning instant" data-value="10.00">RM10.00</a>
                        <a class="btn btn-sm btn-danger instant" data-value="15.00">R15.00</a>
                        <a class="btn btn-sm btn-info instant" data-value="20.00">RM20.00</a>
                    </div>

                    <div class="float-right content">
                        <input class="btn btn-md btn-success " name="submit" type="submit" value="Submit" />
                    </div>

                </div>
            </form>
        </section>
    </div>
</main>

<?php include_once('layout/footer.php') ?>
<script type="text/javascript" src="../../asset/js/jquery.js"></script>
<script type="text/javascript">

    $(".instant").click(function () {
        $("#amount").val($(this).data('value'));
    });

</script>
</html>