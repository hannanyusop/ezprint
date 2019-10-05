<?php

require_once '../../vendor/autoload.php';
//$file = "../../asset/documents/3.pdf";

$mpdf = new \Mpdf\Mpdf();

$c = 0.20;
$bnw = 0.10;


$target_dir = "../../uploads/";

$file_tmp = $_FILES['file']['tmp_name'];
$file_name = $_FILES["file"]["name"];

try{
    move_uploaded_file($file_tmp,$target_dir.$file_name);
}catch (Exception $e){
    var_dump($e);exit();
}


$mpdf->SetImportUse();
$totalPage = $mpdf->SetSourceFile($target_dir.$file_name);
?>

Total Page : <?= $totalPage; ?><br>
Colour:<br>
<input type="radio" name="colour" value="yes"> Colour<br>
<input type="radio" name="colour" value="no"> Black & White



<br><h2>Total Price : RM<span id="total_price">0.00</span></h2>


<script type="text/javascript" src="../../asset/js/jquery.js"></script>
<script type="text/javascript">
    $('input[type=radio][name=colour]').change(function() {

        var total_price, rate, total_page = <?= $totalPage; ?>;

        if (this.value == 'yes') {
            rate = <?= $c ?>;
        }
        else if (this.value == 'no') {
            rate = <?= $bnw ?>;
        }

        total_price = total_page*rate;
        $('#total_price').text(parseFloat(total_price).toFixed(2));
    });
</script>
