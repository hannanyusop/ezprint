<html lang="en">
<?php include_once('layout/header.php') ?>
<?php include_once('../permission_staff.php') ?>
<?php include_once('layout/aside.php') ?>

<?php

    if(isset($_GET['name']) && isset($_GET['email'])){

        $condition = "AND fullname like '%$_GET[name]%' AND  email LIKE '%$_GET[email]%'";

    }else{
        $condition = "";
    }

    $result = $db->query("SELECT *,users.id as customer_id FROM users LEFT JOIN accounts ON users.id=accounts.user_id WHERE role_id=3 ".$condition);
?>



<main role="main">

    <section class="panel important">
        <h2>Customers</h2>
        <form method="get">
            <div class="onethird">
                <input type="text" name="name" value="<?= (isset($_GET['name']))? $_GET['name'] : '' ?>" placeholder="Full Name" />
            </div>
            <div class="onethird">
                <input type="text" name="email" value="<?= (isset($_GET['email']))? $_GET['email'] : '' ?>" placeholder="Email" />
            </div>
            <div class="onethird mb-2">
                <button type="submit" class="btn btn-md btn-info">Search</button>
                <a class="btn btn-md btn-success" href="customer-add.php">Add Customer</a>

            </div>
        </form>
    </section>

    <section class="panel important">
        <div class="content">
            <table>
                <tr>
                    <th>#</th>
                    <th>E-MAIL</th>
                    <th>FULL NAME</th>
                    <th>CREDIT BALANCE</th>
                    <th>REGISTERED DATE</th>
                    <th>ACTION</th>
                </tr>
                <?php if($result->num_rows > 0){ while($customer = $result->fetch_assoc()){ ;?>
                    <tr>
                        <td><?= $customer['id']; ?></td>
                        <td><?= $customer['email']; ?></td>
                        <td><?= $customer['fullname'] ?></td>
                        <td class="font-weight-bold text-success"><?= displayPrice($customer['credit_balance']); ?></td>
                        <td><?= $customer['created_at'] ?></td>
                        <td>
                            <a href="customer-edit.php?id=<?= $customer['customer_id']; ?>" class="font-weight-bold text-info">Edit</a> |
                            <a href="customer-topup.php?id=<?= $customer['customer_id']; ?>" class="font-weight-bold text-success">Topup</a>
                        </td>
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