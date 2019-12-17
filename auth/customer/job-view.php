<html lang="en">
<?php include_once('../permission_customer.php') ?>
<?php include_once('layout/header.php') ?>
<?php
    if(isset($_GET['id'])){
        $result = $db->query("SELECT * FROM jobs WHERE customer_id=$user_id AND id=$_GET[id]");

        $job = $result->fetch_assoc();

        if(!$job){
            echo "<script>alert('Job not found!');window.location='dashboard.php'</script>";
        }

        #add on list
        $job_result = $db->query("SELECT * FROM jobs_has_add_on as a LEFT JOIN add_on as b ON a.add_on_id=b.id WHERE job_id=$job[id]");
    }else{
        echo "<script>alert('Invalid action!');window.location='dashboard.php'</script>";
    }
?>
<?php include_once('layout/aside.php') ?>

<main role="main">
    <div class="offset-3">
        <section class="panel">
            <div class="content">
                <h3>View Job</h3>
                <span>Order Number: #<?= $job['id']; ?></span><br>
                <span>Document: <a target="_blank" href="<?= $job['file']; ?>"> View<a/></span><br>
                <span>Status: <?= getJobStatus($job['status']); ?></span><br>
                <span>Total Paid: <?= displayPrice($job['total_price']); ?></span><br><br>
                <span class="">Pickup Security Code: <?= $job['pickup_code'] ?></span><br>
                <small class="text-info text-sm">Pickup Security Code will be generate after job completed.</small>

                <br><br>Reason:<br><small class="text-info"> <?= $job['notes'] ?></small><br>


                <p>Add on:</p>
                <ul id="pricelist">
                    <?php if($job_result->num_rows > 0){ while($add = $job_result->fetch_assoc()){ ;?>
                        <li><?= strtoupper($add['name'])." - ".displayPrice($add['price']) ?></li>
                    <?php } }else{ ?>
                        <p>No Add On</p>
                    <?php } ?>
                </ul>

                <?php if($job['status'] == '3'){ ?>
                <a href="job-invoice.php?id=<?= $job['id'] ?>" class="btn btn-md btn-info">View Invoice</a>
                <?php } ?>
                <a href="job-list.php" class="btn btn-md btn-success">Back To List</a>
            </div>
        </section>
    </div>
</main>

<?php include_once('layout/footer.php') ?>
</html>