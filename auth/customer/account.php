<html lang="en">
<?php include_once('layout/header.php') ?>
<?php include_once('../permission_customer.php') ?>
<?php include_once('layout/aside.php') ?>
<?php
$result = $db->query("SELECT * FROM credit_transaction WHERE account_id=$user[account_id] ORDER BY created_at DESC");
//    var_dump($result);exit();
?>
<main role="main">
    <section class="panel important">
        <h2>Account Transaction History</h2>
        <table>
            <tr>
                <th>Description</th>
                <th>Job</th>
                <th>Amount</th>
                <th>Current Balance</th>
                <th>Created At</th>
                <th></th>
            </tr>
            <?php if($result->num_rows > 0){ while($transaction = $result->fetch_assoc()){ ;?>
                <tr style="color: <?=($transaction['type'] == 2)? '#E71800' : '#0078e7' ?>">
                    <td><?= getTransactionType($transaction['type']); ?></td>
                    <td>
                        <?php if($transaction['type'] == 2){ ?>
                            <a href="job-view.php?id=<?= $transaction['job_id']; ?>">#0<?= $transaction['job_id'] ?></a>
                        <?php } ?>
                    </td>
                    <td><?= ($transaction['type'] == 2)? "-".displayPrice($transaction['amount']) : "+".displayPrice($transaction['amount']);  ?></td>
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
        </table>
    </section>
</main>

<?php include_once('layout/footer.php') ?>
</html>