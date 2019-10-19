<html lang="en">
<?php include_once('layout/header.php') ?>
<?php include_once('../permission_staff.php') ?>
<?php
    $result = $db->query("SELECT * FROM jobs WHERE status=1");
//    var_dump($result);exit();
?>
<body>
<div id="layout">
    <?php include_once('layout/aside.php'); ?>
    <div id="main">
        <div class="header">
            <h1>Dashboard</h1>
            <h2>Hye, <?= $user['fullname'] ?></h2>
        </div>

        <div class="content">
            <div>
                <h3>Pending job</h3>
                <table class="pure-table">
                    <thead>
                    <tr>
                        <td>Order Number</td>
                        <td>Total Price</td>
                        <td>Status</td>
                        <td>Created At</td>
                        <td>Pickup Date</td>
                        <td></td>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if($result->num_rows > 0){ while($job = $result->fetch_assoc()){ ;?>
                        <tr>
                            <td><?= $job['id']; ?></td>
                            <td><?= displayPrice($job['total_price']); ?></td>
                            <td><?= getJobStatus($job['status']) ?></td>
                            <td><?= $job['created_at'] ?></td>
                            <td><?= $job['pickup_date'] ?></td>
                            <td><a href="job-view.php?id=<?= $job['id']; ?>">View</a> </td>
                        </tr>
                    <?php } }else{ ?>
                        <tr>
                            <td colspan="6">No data</td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php include_once('layout/footer.php'); ?>
</body>
</html>