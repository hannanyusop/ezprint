<?php

require_once '../../env.php';

$mpdf = new \Mpdf\Mpdf();

$c = 0.20;
$bnw = 0.10;


$target_dir = "../../uploads/";

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
$_SESSION['jobs'][1] = $job;

?>

<form action="job-step-3.php" method="post">
    Total Page : <?= $totalPage; ?><br>
    Colour:<br>
    <input type="radio" name="colour" value="1" required> Colour<br>
    <input type="radio" name="colour" value="0" required> Black & White
    <br><h2>Total Price : RM<span id="total_price">0.00</span></h2>

    <a href="job-step-1.php">Previous</a>
    <button type="submit">Next</button>
</form>


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
