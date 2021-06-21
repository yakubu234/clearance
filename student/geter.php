<?php

$PData =json_decode($_SESSION["PData"]);
$userid =  $PData->id;
$username =  $PData->username;
$firstname =  $PData->firstname;
$lastname =  $PData->lastname;
$user_email =  $PData->email;
$matric_num =  $PData->matric_num;
$dept =  $PData->department;
$gender =  $PData->gender;
$phone =  $PData->phone_number;
$status =  $PData->status;
$img =  $PData->img;
if(empty($img)){ $img = 'wrong'; }


function GetPostItems($userid,$matric_num){
	global $conn;
	try {
			$stmt = $conn->prepare('SELECT * FROM uploads WHERE student_tbl_id=? AND student_matric = ?');
			$stmt->execute([$userid, $matric_num]);
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			$user = $stmt->fetch();
			return json_encode($user);			
		} catch(PDOException $e) {
			// echo $sql . "<br>" . $e->getMessage();die;
		}
}


function GetOfficeList(){
	global $conn;
	try {
			$stmt = $conn->prepare('SELECT * FROM roles WHERE auth=? ORDER BY name ASC');
			$stmt->execute(['2']);
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			$user = $stmt->fetchAll();
			return json_encode($user);			
		} catch(PDOException $e) {
			// echo $sql . "<br>" . $e->getMessage();die;
		}
}

function GetDepartments(){
	global $conn;
	try {
			$stmt = $conn->prepare('SELECT * FROM department');
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			$user = $stmt->fetchAll();
			return $user;			
		} catch(PDOException $e) {
			// echo $sql . "<br>" . $e->getMessage();die;
		}
}

function GetUpload_Status($matric_num,$userid){
	global $conn;
	try {
			$stmt = $conn->prepare('SELECT * FROM upload_status WHERE matric_num=? AND student_tbl_id=? ORDER BY status DESC');
			$stmt->execute([$matric_num,$userid]);
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			$user = $stmt->fetchAll();
			return json_encode($user);			
		} catch(PDOException $e) {
			// echo $sql . "<br>" . $e->getMessage();die;
		}
}

function getExtension($ext){
	switch($ext) {
	case "txt":
	$ContentType = "text/plain";
	break;
	case "rtf":
	$ContentType = "application/rtf";
	break;
	case "doc":
	$ContentType = "application/msword";
	break;
	case "docx":
	$ContentType = "application/vnd.openxmlformats-officedocument.wordprocessingml.document";
	break;	
	case "xls":
	$ContentType = "application/vnd.ms-excel";
	break;
	case "pdf":	
	$ContentType = "appliction/pdf";
	break;
	case "png":	
	$ContentType = "image/png";
	break;	
	case "gif":	
	$ContentType = "image/gif";
	break;	
	case "jpg":
	case "jpeg":	
	$ContentType = "image/jpeg";
	break;	
	case "tiff":	
	$ContentType = "image/tiff";
	break;		
	default:
	$ContentType = "application/octet-stream";
	break;		
	}
	return $ContentType;
}

?>