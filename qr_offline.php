<!-- qr_offline.php -->
<?php
require ('vendor/autoload.php');
function QR_GENERATOR($Strings,$filename){
$barcode = new \Com\Tecnick\Barcode\Barcode();
$targetPath = "qr_datas/";

if (! is_dir($targetPath)) {
    mkdir($targetPath, 0777, true);
}
$bobj = $barcode->getBarcodeObj('QRCODE,H', $Strings, - 16, - 16, 'black', array(
    - 2,
    - 2,
    - 2,
    - 2
))->setBackgroundColor('#f0f0f0');

$imageData = $bobj->getPngData();
$filename = $filename.time().".png";
file_put_contents($targetPath .$filename, $imageData);
return $filename;
}

echo  QR_GENERATOR("yakubuabiola2003@gmail.com",'yakubu abiola');
?>