<?php
include "../classes/db.php"; 
	if (!isset($_SESSION["PData"])) {
		$_SESSION['errors'] = "Please login first";
		header('location:../index.php');
	}
include '../admin/geter.php';
$username;
$lastname;

$ds = DIRECTORY_SEPARATOR;  //1 
$storeFolder = 'student';   //2
 
if (!empty($_FILES) && $_FILES['file']['size'] < 410000) {
$allowed =  array('pdf','PDF');
$pathiInfo = $_FILES['file']['name'];
$ext = pathinfo($pathiInfo, PATHINFO_EXTENSION);
if(in_array($ext,$allowed) ) {
  $tempFile = $_FILES['file']['tmp_name'];          //3             
      
    $targetPath = dirname( __FILE__ ) . $ds. $storeFolder . $ds;  //4
    $username =  $username.strtoupper($username).basename($_FILES['file']['name']);
    $targetFile =  $targetPath. $username;  //5
 
    move_uploaded_file($tempFile,$targetFile); //6
    
    echo $username;
}else{
   die('upload not successful please ensure your file is in PDF format and less thank 400kb'); 
}
     
   
}else{
	echo  'upload not successful please ensure your file is not more than 400kb and try again';
}