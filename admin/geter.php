<?php
$PData =json_decode($_SESSION["PData"]);
$userid =  $PData->id;
$username =  $PData->username;
$full_name =  $PData->full_name;
$admin_email =  $PData->email;
$usert_type =  $PData->usert_type;
$role =  $PData->role;
$role_id =  $PData->role_id;
$status =  $PData->status;
$departments =  $PData->departments;


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