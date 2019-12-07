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

        $customer_q = $db->query("SELECT * FROM users WHERE id=$job[customer_id]");
        $customer = $customer_q->fetch_assoc();

        #add on list
        $job_result = $db->query("SELECT * FROM jobs_has_add_on as a LEFT JOIN add_on as b ON a.add_on_id=b.id WHERE job_id=$job[id]");

        if(isset($_POST['accept'])){

            #update job status
            if($_POST['confirm_date'] == '1'){
                $update_job = "UPDATE jobs SET status=2, staff_id=$user_id WHERE id=$job[id]";

                $body = "Your job #$job[id] has approved<br>
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

            }else{

                $merge_date = $_POST['pickup_date']." ".$_POST['pickup_time'];

                if (new DateTime() > new DateTime($merge_date)) {
                    echo "<script>alert('Ops! Please Date & Time Already passed');window.location='job-accept.php?id=".$job[id]."'</script>"; exit();
                }


                #working hour 10am to 10 pm
                if($_POST['pickup_time'] < "10:00" && $_POST['pickup_time'] > "22:00"){
                    echo "<script>alert('Ops! Please select time between 10 AM to 10 PM');window.location='job-accept.php?id=".$job[id]."'</script>";exit();
                }


                $update_job = "UPDATE jobs SET status=2,notes='$_POST[reasons]',pickup_date='$merge_date',staff_id=$user_id WHERE id=$job[id]";

                $body = "Your job #$job[id] has approved but <b>PICKUP DATE has been changed to ".date("H:i A d/M/Y", strtotime($merge_date))." </b>:<br>
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

            }

            if (!$db->query($update_job)) {
                echo "Error: " . $update_job . "<br>" . $db->error; exit();
            }

            sendEmail($customer['email'], "JOB #$job[id] Approved By Admin", $body);
            echo "<script>alert('Successfully!');window.location='job-view.php?id=".$job[id]."'</script>";

        }

    }else{
        echo "<script>alert('Invalid action!');window.location='dashboard.php'</script>";
    }
?>


<main role="main">
    <div class="offset-3">
        <section class="panel">
            <div class="content">
                <h2>Accept : Job Number #<?= $job['id']; ?></h2>
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

                        <label>Please confirm the <b>Pickup Date</b></label>

                        <label for="no">
                            <input type="radio" name="confirm_date" id="ok" value="1" required> I'm okey with the date
                        </label>

                        <label for="yes">
                            <input type="radio" name="confirm_date" id="no" value="0" required> Choose another date
                        </label>

                        <div id="other">
                            <label for="pickup_date">Date</label>
                            <input type="date" name="pickup_date" value="<?= date("Y-m-d", strtotime($job['pickup_date'])) ?>">

                            <label for="pickup_date">Time</label>
                            <input type="time" name="pickup_time" value="<?= date("H:i", strtotime($job['pickup_date'])) ?>">

                            <label for="reasons">Reasons:</label>
                            <textarea style="width: 100%" rows="8" name="reasons" id="reasons"></textarea>
                        </div>
                        <button type="submit" name="accept" class="btn btn-md btn-info float-right">Submit</button>
                        <a href="job-view.php?id=<?= $_GET['id']; ?>" class="btn btn-md btn-warning float-right">Back</a>
                    </form>


                </div>
            </div>
        </section>
    </div>
</main>

<?php include_once('layout/footer.php') ?>
<script type="text/javascript" src="../../asset/js/jquery.js"></script>
<script type="text/javascript">
    $('#other').hide();
    $('input[type=radio][name=confirm_date]').change(function() {

        if($(this).val()  == '1'){
            $('#other').hide();
        }else{
            $('#other').show();
        }
    });
</script>
</html>

