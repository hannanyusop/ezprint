<html lang="en">
<?php include_once('layout/header.php') ?>
<?php include_once('../permission_customer.php') ?>
<?php


    $c = getOption('price_colour', 0.20);
    $bnw = getOption('price_black_and_white', 0.10);

    if(isset($_POST['submit'])){

        $mpdf = new \Mpdf\Mpdf();

        $target_dir = "../../asset/uploads/";

        $file_tmp = $_FILES['file']['tmp_name'];

        $file_name = $_FILES["file"]["name"];
        $file_location = $target_dir.$file_name;

        try{
            move_uploaded_file($file_tmp,$file_location);
        }catch (Exception $e){
            var_dump($e);exit();
        }

        $mpdf->SetImportUse();
        $totalPage = $mpdf->SetSourceFile($file_location);

        $job = ['file' => $file_location, 'total_page' => $totalPage];
        $_SESSION['jobs'][$_SESSION['auth']['user_id']] = $job;

    }else{
        $totalPage = $_SESSION['jobs'][$_SESSION['auth']['user_id']]['total_page'];
    }

?>
<?php include_once('layout/aside.php') ?>


<main role="main">
    <div class="offset-3">
        <section class="panel">
            <h2>Add Job Step 2</h2>
            <form action="job-step-3.php" method="post">
                <div class="content">

                    Total Page : <?= $totalPage; ?><br><br>

                    2. Select PICKUP date & time
                    <label for="pickup_date">Date</label>
                    <input type="date" name="pickup_date" value="<?= (isset($_SESSION['jobs'][$_SESSION['auth']['user_id']]['date']))? $_SESSION['jobs'][$_SESSION['auth']['user_id']]['date'] : date("Y-m-d") ?>">

                    <label for="pickup_date">Time</label>
                    <input type="time" name="pickup_time" value="<?= (isset($_SESSION['jobs'][$_SESSION['auth']['user_id']]['date']))? $_SESSION['jobs'][$_SESSION['auth']['user_id']]['time'] : date("H:i")?>">
                    <small class="text-info text-sm"><br>Notes: Working Hour 10:00 AM - 10:00PM</small><br>
                    <br>
                    3. Select Printing Mode:<br><br>
                    <input type="radio" name="colour" value="1" <?= (isset($_SESSION['jobs'][$_SESSION['auth']['user_id']]['colour']))? ($_SESSION['jobs'][$_SESSION['auth']['user_id']]['colour'] == 'colour')? "checked" : "" : ""; ?> required> Colour (<?= displayPrice($c).'/page' ?>)<br>
                    <input type="radio" name="colour" value="0" <?= (isset($_SESSION['jobs'][$_SESSION['auth']['user_id']]['colour']))? ($_SESSION['jobs'][$_SESSION['auth']['user_id']]['colour'] == 'black & white')? "checked" : "" : ""; ?> required> Black & White (<?= displayPrice($bnw).'/page' ?>)
                    <br><h2 class="text-success m-2">Total Price : RM<span id="total_price">0.00</span></h2>

                    <div class="float-right">
                        <a href="job-step-1.php" class="btn btn-md btn-warning">Previous</a>
                        <input class="btn btn-md btn-success" name="submit" type="submit" value="Next" />
                    </div>

                </div>
            </form>
        </section>
    </div>
</main>

<?php include_once('layout/footer.php') ?>
<script type="text/javascript" src="../../asset/js/jquery.js"></script>
<script type="text/javascript">
    $('input[type=radio][name=colour]').change(function() {

        var total_price, rate, total_page = <?= $totalPage; ?>;

        if (this.value == '1') {
            rate = <?= $c ?>;
        }
        else if (this.value == '0') {
            rate = <?= $bnw ?>;
        }

        total_price = total_page*rate;
        $('#total_price').text(parseFloat(total_price).toFixed(2));
    });
</script>
</html>