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

$storeFolder = 'student';   //2 

if (!empty($_FILES) && $_FILES['file']['size'] < 410000) {

	$allowed =  array('pdf','PDF');
	$pathiInfo = $_FILES['file']['name'];
	$ext = pathinfo($pathiInfo, PATHINFO_EXTENSION);
	if(in_array($ext,$allowed)) {
		
    $tempFile = $_FILES['file']['tmp_name'];          //3             
    
    $targetPath = dirname( __FILE__ ) . $ds. $storeFolder . $ds;  //4
    $usernames =  $username.strtoupper($lastname).basename($_FILES['file']['name']);
    $targetFile =  $targetPath. $usernames;  //5 
    move_uploaded_file($tempFile,$targetFile); //6
    
    $data = ['student_name'=> $fullname,'student_matric'=> $matric_num,'student_tbl_id'=> $userid,'file_name'=> $usernames,'status'=> '1','final_status'=> ''];
    $dataupdate = ['status'=> '1','id'=> $userid,'matric_num'=> $matric_num];
    try {
    	$insert = "INSERT INTO uploads (student_name,student_matric,student_tbl_id,file_name,status,final_status) VALUES (:student_name,:student_matric,:student_tbl_id,:file_name,:status,:final_status)ON DUPLICATE KEY UPDATE student_matric = :student_matric,student_tbl_id = :student_tbl_id , file_name = :file_name, student_name = :student_name, status = :status";
    	$stmtw = $conn->prepare($insert);
    	if ($stmtw->execute($data) > 0) {
    		$sql = "UPDATE students SET status = :status WHERE id  = :id AND matric_num = :matric_num";
    		$stmt= $conn->prepare($sql);
    		$stmt->execute($dataupdate);
    		$stmt->rowCount();	
			#
    		$fetch = $conn->prepare('SELECT * FROM students WHERE id=? AND matric_num = ?');
    		$fetch->execute([$userid, $matric_num]);
    		$result = $fetch->setFetchMode(PDO::FETCH_ASSOC);
    		$user = $fetch->fetch();
    		$_SESSION["PData"] = json_encode($user);
    	}else{
		// return false;
    	}
    } catch(PDOException $e) {
	  // die($e->getMessage());
    }
}else{
	die('upload not successful please ensure your file is in PDF format and less thank 400kb'); 
}

}else{
	die('upload not successful please ensure your file is not more than 400kb and try again');
}