<html lang="en">
<?php include_once('layout/header.php') ?>
<?php include_once('../permission_staff.php') ?>
<?php include_once('layout/aside.php') ?>
<?php

if(isset($_GET['id'])){

    $result = $db->query("SELECT * FROM jobs WHERE id=$_GET[id] AND status=1");

    $job = $result->fetch_assoc();

    if(!$job){
        echo "<script>alert('Job not found!');window.location='dashboard.php'</script>";
    }

    if(isset($_POST['reject'])){

        #customer details
        $customer_sql = $db->query("SELECT *,accounts.id as account_id,users.id as customer_id FROM users LEFT JOIN accounts ON users.id = accounts.user_id WHERE users.id=$job[customer_id]");
        $customer = $customer_sql->fetch_assoc();

        #update job status
        $update_job ="UPDATE jobs SET status=4, staff_id=$user_id,notes='$_POST[reasons]' WHERE id=$job[id]";

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
        }else{
            $body = "Your job #$job[id] created on $job[created_at] has been rejected due:<br>
                            <p>$_POST[reasons]</p><br>
                            For more information please log-in into your dashboard.                             
                            <br><br>
                            <small>
                                <i>This email was generate automatically by system. Don't reply this email
                                    <br>For inquiry please call our Customer Service 06-425635654543</i>
                            </small>
                            <br><br>
                            <small>
                                <i>'To give customers the most compelling printing experience possible' <br>- Hannan Yusop (Managing Director & Founder)</i>
                                <br>
                            </small>";

            sendEmail($customer['email'], "JOB #$job[id] Cancelled By Admin", $body);

            echo "<script>alert('Successfully rejected!');window.location='dashboard.php'</script>";

        }

    }

}else{

    echo "<script>alert('Invalid action!');window.location='dashboard.php'</script>";
}
?>

<main role="main">
    <div class="offset-3">
        <section class="panel">
            <div class="content">
                <h2>Rejection : Order Number: #<?= $job['id']; ?></h2>
                <div class="">

                    <span>Status: <?= getJobStatus($job['status']); ?></span><br>
                    <span>Total Paid: <?= displayPrice($job['total_price']); ?></span><br>
                    <span>Pickup Date: <?= $job['pickup_date'] ?></span><br>

                    <p>
                        <span class="file-detail"><span class="file-item">Document: </span> <?= basename($job['file']) ?></span><br>
                        <span class="file-detail"><span class="file-item">Size: </span>  <?= getFileSize($job['file']) ?> </span><br>
                        <span class="file-detail"><span class="file-item">File Type: </span>  <?= getFileExt($job['file']) ?></span><br>
                    </p>

                    <form method="post">
                        <label for="reasons">Reasons:</label>
                        <textarea style="width: 100%" rows="8" name="reasons" id="reasons" required></textarea>
                        <button type="submit" name="reject" class="btn btn-md btn-info float-right">Submit</button>
                        <a href="job-view.php?id=<?= $_GET['id']; ?>" class="btn btn-md btn-warning float-right">Back</a>
                    </form>


                </div>
            </div>
        </section>
    </div>
</main>

<?php include_once('layout/footer.php') ?>
</html>
