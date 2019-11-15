<html lang="en">
<?php include_once('layout/header.php') ?>
<?php include_once('../permission_customer.php') ?>
<?php
    $user_id = $_SESSION['auth']['user_id'];
    $jobs = $_SESSION['jobs'][$user_id];
    $jobs['addOn'] = [];

    $subtotal = $jobs['price'];

    foreach ($_POST['add-on'] as $id){

        $result = $db->query("SELECT * FROM add_on WHERE is_active=1 AND id=".$id);
        $addOn = $result->fetch_assoc();

        if(!is_null($addOn)){

            $jobs['addOn'][$id]['id'] =  (int)$addOn['id'];
            $jobs['addOn'][$id]['price'] =  (float)$addOn['price'];
            $jobs['addOn'][$id]['name'] =  $addOn['name'];
            $subtotal += $addOn['price'];
        }
    }

    #total price
    $jobs['subtotal'] = (float)$subtotal;

    if($jobs['subtotal'] > $user['credit_balance']){
        echo "<script>alert('Sorry! Credit balance not enough!');window.location='job-step-3.php'</script>";
    }

    #save to session;
    $_SESSION['jobs'][$user_id] = $jobs;

    $credit = (float)$user['credit_balance'];
?>

<?php include_once('layout/aside.php') ?>
<link rel="stylesheet" type="text/css" href="../../asset/css/invoice.css">

<main role="main">
    <section class="panel important">
        <h2>Add Job Step 1</h2>
        <form action="job-step-2.php" method="post" enctype="multipart/form-data">
            <div class="twothirds">

                <div id="page-wrap">

                    <h5 id="header">INVOICE</h5>

                    <div id="identity">
                        <address id="address">
                            Chris Coyier
                            123 Appleseed Street
                            Appleville, WI 53719

                            Phone: (555) 555-5555
                        </address>

                        <div id="logo">
                            <img id="image" src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/9325/logo.png" alt="logo" />
                        </div>
                    </div>

                    <div style="clear:both"></div>

                    <div id="customer">

                        <p id="customer-title">ezPrint Services</p>

                        <table id="meta">
                            <tr>
                                <td class="meta-head">Invoice #</td>
                                <td><p>000123</p></td>
                            </tr>
                            <tr>
                                <td class="meta-head">Date</td>
                                <td><p id="date">December 15, 2009</p></td>
                            </tr>

                        </table>

                    </div>

                    <table id="items">

                        <tr>
                            <th>Item</th>
                            <th>Description</th>
                            <th>Unit Cost</th>
                            <th>Quantity</th>
                            <th>Price</th>
                        </tr>

                        <tr class="item-row">
                            <td class="item-name">Print</td>
                            <td class="description"><?=  $jobs['colour']; ?></td>
                            <td><?= displayPrice(0.20)?></td>
                            <td align="center"><?= $jobs['total_page'] ?> pg(s)</td>
                            <td><?= displayPrice($jobs['price']); ?></td>
                        </tr>

                        <?php foreach ($jobs['addOn'] as $job) { ?>
                            <tr class="item-row">
                                <td class="item-name">Add-on: <?= $job['name'] ?></td>
                                <td class="description"></td>
                                <td><?= displayPrice($job['price']) ?></td>
                                <td align="center">1</td>
                                <td><?= displayPrice($job['price']); ?></td>
                            </tr>
                        <?php } ?>
                        <tr>

                            <td colspan="2" class="blank"> </td>
                            <td colspan="2" class="total-line">Total</td>
                            <td class="total-value"><div id="total"><?= displayPrice($jobs['subtotal']) ?></div></td>
                        </tr>
                        <tr>
                            <td colspan="2" class="blank"> </td>
                            <td colspan="2" class="total-line">Amount Paid</td>

                            <td class="total-value"><?= displayPrice($credit) ?></td>
                        </tr>
                        <tr>
                            <td colspan="2" class="blank"> </td>
                            <td colspan="2" class="total-line balance">Balance Due</td>
                            <td class="total-value balance"><div class="due"><?= displayPrice($credit-$jobs['subtotal']) ?></div></td>
                        </tr>

                    </table>

                    <div id="terms">
                        <h5>Terms</h5>
                        <p>NET 30 Days. Finance Charge of 1.5% will be made on unpaid balances after 30 days.</p>
                    </div>

                </div>

                <a class="btn btn-md btn-warning" href="job-step-3.php">Previous</a>
                <a href="job-step-confirm.php" class="btn btn-md btn-success" type="submit">Confirm</a>
            </div>
        </form>
    </section>
</main>

<?php include_once('layout/footer.php') ?>
</html>