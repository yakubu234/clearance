<?php
include "../classes/db.php"; 
if (!isset($_SESSION["PData"])) {
		$_SESSION['errors'] = "Please login first";
		header('location:../index');
	}
include 'geter.php';

 if (file_exists("../uploads/passports/".$img)) {
    unlink("../uploads/passports/".$img);
    // echo 'File '.$img.' has been deleted';
    $dataupdate = ['img'=> '','id'=> $userid,'matric_num'=> $matric_num];
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
		$_SESSION['success'] = "your passport has been deleted";
		header('location:dashboard');
	} catch(PDOException $e) {
	  // die($e->getMessage());
	}
  } else {
    echo 'Could not delete image file does not exist';
    header('refresh:1;url=dashboard');
  }

	
