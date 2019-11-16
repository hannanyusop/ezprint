<html lang="en">
<?php include_once('layout/header.php') ?>
<?php include_once('../permission_staff.php') ?>
<?php include_once('layout/aside.php') ?>
<?php
    if(isset($_GET['status']) && isset($_GET['name'])){

        if($_GET['status'] != ''){
            $condition = "AND status= $_GET[status] AND email LIKE '%$_GET[name]%'";
        }else{
            $condition = "AND email LIKE '%$_GET[name]%'";
        }

    }else{
        $condition = "";
    }
    $result = $db->query("SELECT *,j.id as job_id,u.id as user_id FROM jobs as j LEFT JOIN users as u ON j.customer_id=u.id  WHERE staff_id=$user_id"." $condition ORDER BY status ASC");
?>
<main role="main">

    <section class="panel important">
        <h2>My Jobs</h2>
        <form method="get">
            <div class="onethird">
                <input type="text" name="name" value="<?= (isset($_GET['name']))? $_GET['name'] : '' ?>" placeholder="Customer Email" />
            </div>
            <div class="onethird">
                <select name="status">
                    <option value="">All Status</option>
                    <?php foreach (getJobStatus() as $key => $status){ ?>
                        <option value="<?= $key ?>" <?= (isset($_GET['status']))? ($_GET['status'] == $key)? 'selected' : '' : '' ?>><?= $status; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="onethird mb-2">
                <button type="submit" class="btn btn-md btn-info">Search</button>
            </div>
        </form>
    </section>

    <section class="panel important">
        <div class="content">
            <table>
                <tr>
                    <th>Order Number</th>
                    <th>Name</th>
                    <th>E-mail</th>
                    <th>Total Price</th>
                    <th>Status</th>
                    <th>Created At</th>
                    <th>Pickup Date</th>
                    <th></th>
                </tr>
                <?php if($result->num_rows > 0){ while($job = $result->fetch_assoc()){ ;?>
                    <tr>
                        <td><?= $job['job_id']; ?></td>
                        <td><?= $job['fullname']; ?></td>
                        <td><?= $job['email']; ?></td>
                        <td><?= displayPrice($job['total_price']); ?></td>
                        <td><?= getJobStatus($job['status']) ?></td>
                        <td><?= $job['created_at'] ?></td>
                        <td><?= $job['pickup_date'] ?></td>
                        <td><a class="text-info font-weight-bold" href="job-view.php?id=<?= $job['job_id']; ?>">View</a> </td>
                    </tr>
                <?php } }else{ ?>
                    <tr>
                        <td class="text-center" colspan="6">No data</td>
                    </tr>
                <?php } ?>
            </table>
        </div>
    </section>
</main>

<?php include_once('layout/footer.php') ?>
</html>