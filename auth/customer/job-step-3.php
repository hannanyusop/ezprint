<html lang="en">
<?php include_once('../permission_customer.php') ?>
<?php include_once('layout/header.php') ?>
<?php include_once('layout/aside.php') ?>

<?php

    $c = getOption('price_colour', 0.20);
    $bnw = getOption('price_black_and_white', 0.10);

    if(isset($_POST['colour'])){

        $user_id = $_SESSION['auth']['user_id'];

        $merge_date = $_POST['pickup_date']." ".$_POST['pickup_time'];


        $colour = (int)$_POST['colour'];
        $jobs = $_SESSION['jobs'][$user_id];

        #insert price to session
        $rate = ($colour == 1)? $c : $bnw;
        $price = $jobs['total_page']*$rate;

        $jobs['price'] = $price;
        $jobs['colour'] = ($colour == 1)? "colour" : "black & white";
        $jobs['mode'] = $colour;
        $jobs['mode_price'] = $rate;
        $jobs['date'] = $_POST['pickup_date'];
        $jobs['time'] = $_POST['pickup_time'];
        $jobs['datetime'] = $merge_date;

        #save to session;
        $_SESSION['jobs'][$user_id] = $jobs;

        if (new DateTime() > new DateTime($merge_date)) {
            echo "<script>alert('Ops! Please Date & Time Already passed');window.location='job-step-2.php'</script>"; exit();
        }

        #working hour 10am to 10 pm
        if($_POST['pickup_time'] < "10:00" || $_POST['pickup_time'] > "22:00"){
            echo "<script>alert('Ops! Please select time between 10 AM to 10 PM');window.location='job-step-2.php'</script>";exit();
        }

    }elseif (isset($_SESSION['jobs'][$user_id]['colour'])){
        $jobs = $_SESSION['jobs'][$user_id];
    }else{
        echo "<script>alert('Invalid action');window.location='job-step-1.php'</script>";
    }

    $result = $db->query("SELECT * FROM add_on WHERE is_active=1");

?>


<main role="main">
    <div class="offset-3">
        <section class="panel">
            <h2>Add Job Step 3</h2>
            <form action="job-step-4.php" method="post" enctype="multipart/form-data">
                <div class="content">


                    <h4 class="text-success">ACCOUNT BALANCE : <?= displayPrice($user['credit_balance']) ?></h4>
                    <label>4. Pick Add-on</label>
                    <div id="pricelist" class="content">
                        <?php if($result->num_rows > 0){ while($add = $result->fetch_assoc()){ ;?>
                            <input type="checkbox" name="add-on[]" value="<?= $add['id'] ?>" data-price="<?= $add['price']; ?>" <?= getCheckedAddOn($add['id']) ?>> <?= $add['name']."(".displayPrice($add['price']).")" ?><br>
                        <?php } }else{ ?>
                            <p>No Add On</p>
                        <?php } ?>
                    </div>

                    <br>
                    <h3>
                        <small>Printing Mode Price : <?= displayPrice($jobs['price']); ?></small><br>
                        </span>
                    </h3>
                    <h2 class="text-success">Total Price : <span id="subtotal"><?= displayPrice($jobs['price']); ?></h2>

                    <div class="float-right content">
                        <a href="job-step-2.php" class="btn btn-md btn-warning">Previous</a>
                        <input class="btn btn-md btn-success" name="submit" type="submit" value="Next" />
                    </div>

                </div>
            </form>
        </section>
    </div>
</main>

<?php include_once('layout/footer.php') ?>
<script type="text/javascript" src="../../asset/js/jquery.js"></script>
<script>
    function  cal() {
        $('input:checkbox').change(function () {

            var total = <?= (float)$jobs['price'] ?>;
            $('input:checkbox:checked').each(function(){
                total += isNaN(parseInt($(this).val())) ? 0 : parseFloat($(this).data('price'));
            });

            $("#subtotal").text("RM "+parseFloat(total).toFixed(2));
        });
    }

    $('#pricelist :checkbox').click(function(){
        cal();
    });


    cal();

</script>

</html>