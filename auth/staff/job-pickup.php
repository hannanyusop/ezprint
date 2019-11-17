<html lang="en">
<?php include_once('layout/header.php') ?>
<?php include_once('../permission_staff.php') ?>
<?php include_once('layout/aside.php') ?>
<?php
    if(isset($_GET['id'])){

        $result = $db->query("SELECT * FROM jobs WHERE id=$_GET[id] AND status=3");
        $job = $result->fetch_assoc();

        if(!$job){
            echo "<script>alert('Job not found!');window.location='dashboard.php'</script>";
        }
        #add on list
        $job_result = $db->query("SELECT * FROM jobs_has_add_on as a LEFT JOIN add_on as b ON a.add_on_id=b.id WHERE job_id=$job[id]");


    }else{
        echo "<script>alert('Invalid action!');window.location='job-list.php'</script>";
    }
?>

<main role="main">

    <div class="offset-3">
        <section class="panel">
            <h2>Pickup  Order Number: #<?= $job['id']; ?></h2>
            <div class="content">

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

                <p class="text-center">
                    <a class="pdf-thumbnail" href="<?= $job['file']; ?>"><i class="fa fa-5x fa-file-pdf-o"></i></a><br>
                    <small class="tips success">Click icon to view or download file</small><br>
                </p>

                <p>
                    <span class="file-detail"><span class="file-item">Document: </span> <?= basename($job['file']) ?></span><br>
                    <span class="file-detail"><span class="file-item">Size: </span>  <?= getFileSize($job['file']) ?> </span><br>
                    <span class="file-detail"><span class="file-item">File Type: </span>  <?= getFileExt($job['file']) ?></span><br>
                </p>

                <hr>
                <form method="post" class="text-center content">

                    <p class="text-success text-md">Code already sent to customer email or check on their dashboard and usually contain <span class="font-weight-bold">5 character</span></p>


                    <?php
                        if(isset($_POST['check_code'])){

                            $_SESSION[$user_id]['code'] = $_POST['code'];

                            if($job['pickup_code'] == strtoupper($_POST['code'])){
                                $db->query("UPDATE jobs SET status=5 WHERE id=$job[id]");

                                echo "<script>alert('Code Accepted!');window.location='job-view.php?id=$_GET[id]'</script>";
                            }else{ ?>

                                <div class="feedback error">Ops! You've entered wrong Pickup Security Code!</div>

                           <?php }
                        }
                    ?>
                    <input type="text" class="form-lg uppercase" minlength="5" name="code" placeholder="Pickup Security Code (EX: SH2R7)" value="<?= (isset($_SESSION[$user_id]['code']))? $_SESSION[$user_id]['code'] : "" ?>" required>
                    <button type="submit" name="check_code" class="btn btn-lg btn-success">Apply Code</button>

                </form>
                <hr>
            </div>
            <div class="content float-right">
                <a href="job-list.php" class="btn btn-md btn-warning">Back</a>

            </div>
        </section>
    </div>
</main>

<?php include_once('layout/footer.php') ?>
</html>