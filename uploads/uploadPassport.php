<?php
include "../classes/db.php"; 
global $conn;
// include "../classes/action.php"; 
	if (!isset($_SESSION["PData"])) {
		$_SESSION['errors'] = "Please login first";
		header('location:../index.php');
	}
include '../student/geter.php';

$fullname = $firstname." ".$lastname;

$ds = DIRECTORY_SEPARATOR;  //1
 
$storeFolder = 'passports';   //2 
 
if (!empty($_FILES) && $_FILES['file']['size'] < 410000) {
     
    $tempFile = $_FILES['file']['tmp_name'];          //3             
      
    $targetPath = dirname( __FILE__ ) . $ds. $storeFolder . $ds;  //4
    $username =  rand().$username.strtoupper($lastname).basename($_FILES['file']['name']);
    $targetFile =  $targetPath. $username;  //5 
    move_uploaded_file($tempFile,$targetFile); //6

$dataupdate = ['img'=> $username,'id'=> $userid,'matric_num'=> $matric_num];
	try {
		$sql = "UPDATE students SET img = :img WHERE id  = :id AND matric_num = :matric_num";
		$stmt= $conn->prepare($sql);
		$stmt->execute($dataupdate);
		$stmt->rowCount();	
		#
		$fetch = $conn->prepare('SELECT * FROM students WHERE id=? AND matric_num = ?');
		$fetch->execute([$userid, $matric_num]);
		$result = $fetch->setFetchMode(PDO::FETCH_ASSOC);
		$user = $fetch->fetch();
		$_SESSION["PData"] = json_encode($user);
		header('location:../student/dashboard');
	} catch(PDOException $e) {

	  // die($e->getMessage());
	}
}else{
  die('upload not successful please ensure your file is not more than 400kb and try again');
}