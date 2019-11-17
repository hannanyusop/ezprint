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
        <h2>Add Job Step 4</h2>
        <form action="job-step-2.php" method="post" enctype="multipart/form-data">
            <div class="content">

                <div id="page-wrap">

                    <h5 id="header">QUOTATION</h5>

                    <div id="identity">
                        <address id="address">
                            <?= $user['fullname']; ?><br>

                            Email: <?= $user['email']; ?>
                        </address>

                        <div id="logo">
                            <img id="image" src="../../asset/image/logo.png" alt="logo" height="110">
                        </div>
                    </div>

                    <div style="clear:both"></div>

                    <div id="customer">

                        <p id="customer-title">ezPrint Services</p>

                        <table id="meta">
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

                    </table>

                </div>

                <div class="float-right content">
                    <a class="btn btn-md btn-warning" href="job-step-3.php">Previous</a>
                    <a href="job-step-confirm.php" class="btn btn-md btn-success" type="submit">Confirm</a>
                </div>
            </div>
        </form>
    </section>
</main>

<?php include_once('layout/footer.php') ?>
</html>