<?php
include "../classes/db.php"; 
if (!isset($_SESSION["PData"])) {
		$_SESSION['errors'] = "Please login first";
		header('location:../index.php');
	}
include 'geter.php';
$userid;
$admin_email;
$full_name;
if(isset($_GET['strings']) && $_GET['params']=='DenyStudentClearance'){		
	$Student_ID = $_GET['data'];$ADMIN_ROLE_ID = $_GET['roler'];$role;
	
	if($role = 'Super Admin'){
		$_SESSION['errors'] = ' OOOps!. you cannot deny student as a super admin. kindly login as an officer ';
		header('location:viewAllStudent?strings='.time());
	}
    echo '
    the design page is still under construction
    ';
	
}else if(isset($_POST['final_deny'])){
    # update once request is made
	$data = [
		'status' => '3',
		'student_tbl_id' => $Student_ID,
		'roles' => $role
		];
		$sql = "UPDATE upload_status SET status = :status WHERE roles  = :roles AND student_tbl_id = :student_tbl_id";
		$stmtUp= $conn->prepare($sql);
		$stmtUp->execute($data);
	
	$_SESSION['success'] = ' success!. student has been declined by you ';
	header('location:viewIdividual?strings='.time());
}else{
    header('location:'.$urlServer);
}
?>