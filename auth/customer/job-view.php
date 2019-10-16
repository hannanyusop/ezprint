<html lang="en">
<?php include_once('layout/header.php') ?>
<?php include_once('../permission_customer.php') ?>
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
<body>
<div id="layout">
    <?php include_once('layout/aside.php'); ?>
    <div id="main">
        <div class="header">
            <h1>View Job</h1>
            <h2>A subtitle for your page goes here</h2>
        </div>

        <div class="content">
            <div>
                <h5>*Please call our customer service at +6010-5960586 for fast respond.</h5>
            </div>

            <span>Order Number: #<?= $job['id']; ?></span><br>
            <span>Document: <a target="_blank" href="<?= $job['file']; ?>"> View<a/></span><br>
            <span>Status: <?= getJobStatus($job['status']); ?></span><br>
            <span>Total Paid: <?= displayPrice($job['total_price']); ?></span><br>

            <p>Add on:</p>
            <ul id="pricelist">
                <?php if($job_result->num_rows > 0){ while($add = $job_result->fetch_assoc()){ ;?>
                    <li><?= strtoupper($add['name'])." - ".displayPrice($add['price']) ?></li>
                <?php } }else{ ?>
                    <p>No Add On</p>
                <?php } ?>
            </ul>
        </div>
    </div>
</div>
<?php include_once('layout/footer.php'); ?>
</body>
</html>
