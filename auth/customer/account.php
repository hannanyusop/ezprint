<html lang="en">
<?php include_once('layout/header.php') ?>
<?php include_once('../permission_customer.php') ?>
<?php
    $result = $db->query("SELECT * FROM credit_transaction WHERE account_id=$user[account_id]");
//    var_dump($result);exit();
?>
<body>
<div id="layout">
    <?php include_once('layout/aside.php'); ?>
    <div id="main">
        <div class="header">
            <h1>Transaction History</h1>
            <h2>ACCOUNT BALANCE: <?= displayPrice($user['credit_balance']) ?></h2>
        </div>

        <div class="content">
            <div>
                <h5>*Note:</h5>
                <table class="pure-table">
                    <thead>
                    <tr>
                        <td>Description</td>
                        <td>Job</td>
                        <td>Amount</td>
                        <td>Current Balance</td>
                        <td>Created At</td>
                        <td></td>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if($result->num_rows > 0){ while($transaction = $result->fetch_assoc()){ ;?>
                        <tr>
                            <td><?= getTransactionType($transaction['type']); ?></td>
                            <td>
                                <?php if($transaction['type'] == 2){ ?>
                                    <a href="job-view.php?id=<?= $transaction['job_id']; ?>">#0<?= $transaction['job_id'] ?></a>
                                <?php } ?>
                            </td>
                            <td><?= displayPrice($transaction['amount']) ?></td>
                            <td><?= displayPrice($transaction['current_balance']) ?></td>
                            <td><?= $transaction['created_at'] ?></td>
                            <td>
                                <a href="receipt">View Receipt</a>
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
