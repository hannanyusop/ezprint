<?php

require_once '../../vendor/autoload.php';
$file = "../../asset/documents/3.pdf";

$mpdf = new \Mpdf\Mpdf();

$mpdf->SetImportUse();

$totalPage = $mpdf->SetSourceFile($file);

var_dump($totalPage);exit();