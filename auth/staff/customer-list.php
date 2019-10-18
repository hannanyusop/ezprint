<html lang="en">
<?php include_once('layout/header.php') ?>
<?php include_once('../permission_staff.php') ?>
<?php
    $result = $db->query("SELECT *,users.id as customer_id FROM users LEFT JOIN accounts ON users.id=accounts.user_id WHERE role_id=3");
//    var_dump($result);exit();
?>
<body>
<div id="layout">
    <?php include_once('layout/aside.php'); ?>
    <div id="main">
        <div class="header">
            <h1>CUSTOMER LIST</h1>
            <h2>Hye, <?= $user['fullname'] ?></h2>
        </div>

        <div class="content">
            <div>
                <h3><a href="customer-add.php">Add Customer</a> </h3>
                <table class="pure-table">
                    <thead>
                    <tr>
                        <td>#</td>
                        <td>E-MAIL</td>
                        <td>FULL NAME</td>
                        <td>CREDIT BALANCE</td>
                        <td>REGISTERED DATE</td>
                        <td>ACTION</td>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if($result->num_rows > 0){ while($customer = $result->fetch_assoc()){ ;?>
                        <tr>
                            <td><?= $customer['id']; ?></td>
                            <td><?= $customer['email']; ?></td>
                            <td><?= $customer['fullname'] ?></td>
                            <td><?= displayPrice($customer['credit_balance']); ?></td>
                            <td><?= $customer['created_at'] ?></td>
                            <td>
                                <span>
                                    <a href="customer-view.php?id=<?= $customer['customer_id']; ?>" class="pure-button pure-button-primary">View</a>
                                    <a href="customer-topup.php?id=<?= $customer['customer_id']; ?>" class="pure-button pure-button-info">Topup</a>
                                </span>
                            </td>
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
