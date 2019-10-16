<?php include_once('../permission_customer.php') ?>
<?php

$mpdf = new \Mpdf\Mpdf();

$c = 0.20;
$bnw = 0.10;


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

?>

<html lang="en">
<?php include_once('layout/header.php') ?>
<body>
<div id="layout">
    <?php include_once('layout/aside.php'); ?>
    <div id="main">
        <div class="header">
            <h1>Create Printing Job</h1>
            <h2>Step 2</h2>
        </div>

        <div class="content">
            <div>
                <h6><br></h6>
            
                <form action="job-step-3.php" method="post">
                    Total Page : <?= $totalPage; ?><br>
                    Colour:<br>
                    <input type="radio" name="colour" value="1" required> Colour<br>
                    <input type="radio" name="colour" value="0" required> Black & White
                    <br><h2>Total Price : RM<span id="total_price">0.00</span></h2>

                    <a href="job-step-1.php" class="button-f pure-button">Previous</a>
                    <button type="submit" class="button-f pure-button">Next</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include_once('layout/footer.php'); ?>
</body>
</html>



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
