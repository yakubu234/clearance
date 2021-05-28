<?php

function QR_GENERATOR($data,$filename){
// QRCode size
$size = '250x250';
// Path to image (web or local)
$logo = 'qrcodeOnline/FUNAAB-Logo.png';
$QR = imagecreatefrompng('https://chart.googleapis.com/chart?cht=qr&chld=H|1&chs='.$size.'&chl='.urlencode($data));
# START TO DRAW THE IMAGE ON THE QR CODE
$logo = imagecreatefromstring(file_get_contents($logo));
$QR_width = imagesx($QR);
$QR_height = imagesy($QR);
$logo_width = imagesx($logo);
$logo_height = imagesy($logo);
# Scale logo to fit in the QR Code
$logo_qr_width = $QR_width/4.5;
$scale = $logo_width/$logo_qr_width;
$logo_qr_height = $logo_height/$scale;
imagecopyresampled($QR, $logo, $QR_width/2.5, $QR_height/2.7, 4, 1, $logo_qr_width, $logo_qr_height, $logo_width, $logo_height);
$targetPath = "qr/";    
    if (! is_dir("qrcodeOnline/".$targetPath)) {
        mkdir($targetPath, 0777, true);
    }
$filename = $filename.time().".png";
$targetPath = $targetPath.$filename;
imagepng($QR,"qrcodeOnline/".$targetPath);
imagedestroy($QR);
chmod("qrcodeOnline/".$targetPath, 0777);
return $filename;
}
?>
