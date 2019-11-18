<html lang="en">
<?php include_once('../permission_customer.php') ?>
<?php
    if(isset($_GET['id'])){

        $job_q = $db->query("SELECT * FROM jobs WHERE customer_id=$user_id AND id=$_GET[id] AND status=3");
        $job = $job_q->fetch_assoc();

        if(!$job){
            #not found
            echo "<script>alert('Job not found!');window.location='job-list.php'</script>";
            exit();
        }

        $customer_q = $db->query("SELECT * FROM users WHERE id=$job[customer_id]");
        $customer = $customer_q->fetch_assoc();

        $add_on_q = $db->query("SELECT * FROM jobs_has_add_on as a LEFT JOIN add_on as b ON a.add_on_id=b.id WHERE job_id=$job[id]");

    }else{
        echo "<script>alert('Invalid parameter!');window.location='job-list.php'</script>";
        exit();
    }
?>

<link rel="stylesheet" type="text/css" href="../../asset/css/invoice.css">
<main role="main">
    <section class="panel important">
        <div class="content" id="myDiv">

                <div id="page-wrap">

                    <h5 id="header">INVOICE</h5>

                    <div id="identity">
                        <address id="address">
                            <?= $customer['fullname']; ?><br>

                            Email: <?= $customer['email']; ?>
                        </address>

                        <div id="logo">
                            <img id="image" src="../../asset/image/logo.png" alt="logo" height="110">
                        </div>
                    </div>

                    <div style="clear:both"></div>

                    <div id="customer">

                        <p id="customer-title">ezPrint<span class="text-xs">By Devtech Sdn Bhd</span></p>

                        <table id="meta">
                            <tr>
                                <td class="meta-head">Invoice </td>
                                <td><p>#<?= $job['id'] ?></p></td>
                            </tr>
                            <tr>
                                <td class="meta-head">Date</td>
                                <td><p id="date"><?= date("d F Y", strtotime($job['created_at'])) ?></p></td>
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
                            <td class="description">Mode: <?= getPrintingMode($job['printing_mode']) ?></td>
                            <td><?= displayPrice($job['printing_mode_price'])?></td>
                            <td align="center"><?= $job['total_page'] ?> pg(s)</td>
                            <td><?= displayPrice($job['printing_mode_price']*$job['total_page']); ?></td>
                        </tr>

                        <?php if($add_on_q->num_rows > 0){ while($add = $add_on_q->fetch_assoc()){ ;?>
                            <tr class="item-row">
                                <td class="item-name">Add-on: <?= $add['name'] ?></td>
                                <td class="description"></td>
                                <td><?= displayPrice($add['price']) ?></td>
                                <td align="center">1</td>
                                <td><?= displayPrice($add['price']); ?></td>
                            </tr>
                        <?php }  }?>
                        <tr>

                            <td colspan="2" class="blank"> </td>
                            <td colspan="2" class="total-line">Total</td>
                            <td class="total-value"><div id="total"><?= displayPrice($job['total_price']) ?></div></td>
                        </tr>
                        <tr>
                            <td colspan="2" class="blank"> </td>
                            <td colspan="2" class="total-line">Amount Paid</td>

                            <td class="total-value"><?= displayPrice($job['total_price']) ?></td>
                        </tr>

                    </table>
                </div>
            </div>
    </section>
</main>

</html>
<script type="text/javascript" src="../../asset/js/jquery.js"></script>
<script>
    $( document ).ready(function() {
        window.print();
    });
</script>