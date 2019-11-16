<html lang="en">
<?php include_once('layout/header.php') ?>
<?php include_once('../permission_customer.php') ?>
<?php include_once('layout/aside.php') ?>
<?php
$result = $db->query("SELECT * FROM jobs WHERE customer_id=$user_id ORDER BY status ASC");
//    var_dump($result);exit();
?>
<main role="main">
    <section class="panel important">
        <div class="content">
            <h4 class="text-success">Welcome back, <i><?= $user['fullname'] ?></i> </h4>
            <ul>
                <li>Important panel that will always be really wide Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</li>
                <li>Aliquam tincidunt mauris eu risus.</li>
                <li>Vestibulum auctor dapibus neque.</li>
            </ul>
        </div>
    </section>
    <section class="panel">
        <h2>My Jobs</h2>
        <table>
            <tr>
                <th>Order Number</th>
                <th>Total Price</th>
                <th>Status</th>
                <th>Created At</th>
                <th>Pickup Date</th>
                <th></th>
            </tr>
            <?php if($result->num_rows > 0){ while($job = $result->fetch_assoc()){ ;?>
                <tr>
                    <td><?= $job['id']; ?></td>
                    <td><?= displayPrice($job['total_price']); ?></td>
                    <td><?= getJobStatus($job['status']) ?></td>
                    <td><?= $job['created_at'] ?></td>
                    <td><?= $job['pickup_date'] ?></td>
                    <td>
                        <a href="job-view.php?id=<?= $job['id']; ?>">View</a>
                        <?php if($job['status'] == 1){ ?>
                            <a class="text-danger"  onclick="return confirm('Are you sure want to delete this job?')" href="job-delete.php?id=<?= $job['id'] ?>">Delete</a>
                        <?php } ?>
                    </td>
                </tr>
            <?php } }else{ ?>
                <tr>
                    <td class="text-center" colspan="6">No data</td>
                </tr>
            <?php } ?>
        </table>
    </section>
    <section class="panel">
        <h2>Chart</h2>
        <ul>
            <li>ACCOUNT BALANCE: <?= displayPrice($user['credit_balance']) ?></li>
        </ul>
    </section>
</main>

<?php include_once('layout/footer.php') ?>
</html>