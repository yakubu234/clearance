<?php
include "../classes/db.php"; 
if (!isset($_SESSION["PData"])) {
		$_SESSION['errors'] = "Please login first";
		header('location:../index');
	}
include 'geter.php';
$uploads = json_decode(GetPostItems($userid,$matric_num));
$file = $uploads->file_name;
$ext = getExtension(pathinfo($file, PATHINFO_EXTENSION));
 if (file_exists("../uploads/student/".$file)) {
    unlink("../uploads/student/".$file);
    // echo 'File '.$img.' has been deleted';
    $dataupdate = ['status'=> '','id'=> $userid,'matric_num'=> $matric_num];
	try {
		$sql = "UPDATE students SET status = :status WHERE id  = :id AND matric_num = :matric_num";
		$stmt= $conn->prepare($sql);
		$stmt->execute($dataupdate);
		$stmt->rowCount();	
		#
		#delete from the upload_status
		$stmtD = $conn->prepare("DELETE a.*, b.* FROM upload_status a JOIN uploads b ON a.matric_num = b.student_matric WHERE a.student_tbl_id= :student_tbl_id AND a.matric_num=:matric_num");
    	$stmtD->bindValue(':student_tbl_id',$userid);
    	$stmtD->bindValue(':matric_num',$matric_num);
    	$stmtD->execute();
		#
		$fetch = $conn->prepare('SELECT * FROM students WHERE id=? AND matric_num = ?');
		$fetch->execute([$userid, $matric_num]);
		$result = $fetch->setFetchMode(PDO::FETCH_ASSOC);
		$user = $fetch->fetch();
		$_SESSION["PData"] = json_encode($user);
		$_SESSION['success'] = "your document has been deleted, kindly upload new one";
		header('location:dashboard');
	} catch(PDOException $e) {
	  // die($e->getMessage());
	}
  } else {
    echo 'Could not delete document file does not exist';
    header('refresh:1;url=dashboard');
  }
