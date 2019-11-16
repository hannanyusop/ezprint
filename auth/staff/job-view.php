<html lang="en">
<?php include_once('layout/header.php') ?>
<?php include_once('../permission_staff.php') ?>
<?php include_once('layout/aside.php') ?>
<?php
    if(isset($_GET['id'])){
        $result = $db->query("SELECT * FROM jobs WHERE id=$_GET[id]");

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

<main role="main">

    <div class="offset-3">
        <section class="panel">
            <h2>Order Number: #<?= $job['id']; ?></h2>
            <div class="twothirds">

                <span>Status: <?= getJobStatus($job['status']); ?></span><br>
                <span>Total Paid: <?= displayPrice($job['total_price']); ?></span><br>
                <span>Pickup Date: <?= $job['pickup_date'] ?></span><br>

                <p>Add on:</p>
                <ul id="pricelist">
                    <?php if($job_result->num_rows > 0){ while($add = $job_result->fetch_assoc()){ ;?>
                        <li><?= strtoupper($add['name'])." - ".displayPrice($add['price']) ?></li>
                    <?php } }else{ ?>
                        <p>No Add On</p>
                    <?php } ?>
                </ul>
            </div>
            <div class="onethirds">
                <p class="text-center">
                    <a class="pdf-thumbnail" href="<?= $job['file']; ?>"><i class="fa fa-5x fa-file-pdf-o"></i></a><br>
                    <small class="tips success">Click icon to view or download file</small><br>
                </p>

                <p>
                    <span class="file-detail"><span class="file-item">Document: </span> <?= basename($job['file']) ?></span><br>
                    <span class="file-detail"><span class="file-item">Size: </span>  <?= getFileSize($job['file']) ?> </span><br>
                    <span class="file-detail"><span class="file-item">File Type: </span>  <?= getFileExt($job['file']) ?></span><br>
                </p>
                <div class="float-bottom content">
                    <?php if($job['status'] == 1){ ?>
                        <a href="job-accept.php?id=<?= $job['id'] ?>" class="btn btn-md btn-success">Accept</a>
                        <a href="job-reject.php?id=<?= $job['id'] ?>" class="btn btn-md btn-danger">Reject</a>
                    <?php } ?>

                    <?php if($job['status'] == 2 && $job['staff_id'] == $user_id){ ?>
                        <a href="job-complete.php?id=<?= $job['id'] ?>" class="btn btn-md btn-info" onclick="return confirm('Are you sure?')">Mark As Complete</a>
                    <?php } ?>
                </div>
            </div>
        </section>
    </div>
</main>

<?php include_once('layout/footer.php') ?>
</html>