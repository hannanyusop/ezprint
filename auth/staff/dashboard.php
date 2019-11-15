<html lang="en">
<?php include_once('layout/header.php') ?>
<?php include_once('../permission_staff.php') ?>
<?php include_once('layout/aside.php') ?>

<?php
    $pending = $db->query("SELECT * FROM jobs WHERE status=1");
    $in_progress = $db->query("SELECT * FROM jobs WHERE status=2");
?>

    <main role="main">
        <section class="panel ">
            <h2>In Progress Job</h2>
            <table>
                <tr>
                    <th>Order Number</th>
                    <th>Total Price</th>
                    <th>Status</th>
                    <th>Created At</th>
                    <th>Pickup Date</th>
                    <th></th>
                </tr>
                <?php if($in_progress->num_rows > 0){ while($job = $in_progress->fetch_assoc()){ ;?>
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
                        <td class="text-center" colspan="6">No data</td>
                    </tr>
                <?php } ?>
            </table>
        </section>
        <section class="panel ">
            <h2>Pending Job</h2>
            <table>
                <tr>
                    <th>Order Number</th>
                    <th>Total Price</th>
                    <th>Status</th>
                    <th>Created At</th>
                    <th>Pickup Date</th>
                    <th></th>
                </tr>
                <?php if($pending->num_rows > 0){ while($pending_job = $pending->fetch_assoc()){ ;?>
                    <tr>
                        <td><?= $pending_job['id']; ?></td>
                        <td><?= displayPrice($pending_job['total_price']); ?></td>
                        <td><?= getJobStatus($pending_job['status']) ?></td>
                        <td><?= $pending_job['created_at'] ?></td>
                        <td><?= $pending_job['pickup_date'] ?></td>
                        <td><a href="job-view.php?id=<?= $pending_job['id']; ?>">View</a> </td>
                    </tr>
                <?php } }else{ ?>
                    <tr>
                        <td class="text-center" colspan="6">No data</td>
                    </tr>
                <?php } ?>
            </table>
        </section>
    </main>

<?php include_once('layout/footer.php') ?>
</html>