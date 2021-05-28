<?php
include "db.php"; 
if (!isset($_SESSION["PData"])) {
		$_SESSION['errors'] = "Please login first";
		header('location:../index.php');
	}
include '../admin/geter.php';
$userid;
$admin_email;
$full_name;
if (isset($_POST['add_admin']) && $_POST['add_admin']=='add_admin') {
	$username = $_POST['username'];
	$fullname = $_POST['fullname'];
	$email = $_POST['email'];
	$user_type = '3';
	$role = $_POST['role'];	
	$role_id = $_POST['role_id'];
	$departments = $_POST['departments'];
	if (!empty($departments)) {
		$user_type ="2";
	}
	$passwordH = MD5(strtoupper($_POST['password']));
	$password = crypt($passwordH,$passwordH);	
	$function = "admin with name  ".$full_name." has added ".$username." as an admin with  ".$role." role" ;
	LoadUser($userid, $full_name, $admin_email, $function);
	try {
		$data = [
		'username' => $username,
		'password' => $password,
		'full_name' => $fullname,
		'email' => $email,
		'usert_type' => $user_type,
		'role' => $role,
		'departments' => $departments,
		'role_id' => $role_id,
		'status' => '1',
		];
		$ins = "INSERT INTO admin (username,password,full_name,email,usert_type,role,departments,role_id,status) VALUES (:username, :password, :full_name, :email, :usert_type,:role,:departments,:role_id,:status)";
		$stmt = $conn->prepare($ins);
		if ($stmt->execute($data) > 0) {
		$_SESSION['success'] = ' success!. '.$fullname.' has been added as admin ';
		}else{
		$_SESSION['errors'] = ' an error has occured , please retry adding '.$fullname;
		}
		header('Refresh: 0; url=../admin/viewAdmin.php?strings='.time());
	} catch(PDOException $e) {
		// echo $sql . "<br>" . $e->getMessage();die;
		$_SESSION['errors'] = ' an error has occured , please retry adding '.$fullname;
		header('location:../admin/addAdmin.php');
	}
	# code...
}

if (isset($_POST['requestClearane']) && $_POST['requestClearane']=='requestClearane') {
	$matric = $_POST['matric'];
	$tbl_id = $_POST['tbl_id'];
	$user_email = $_POST['user_email'];
	$f_name = $_POST['f_name'];	
	
	$function = "Student  with name  ". $f_name." just requested for his/her clearance be verified ";
	LoadUser($tbl_id, $f_name, $user_email, $function);
	try {
		#if the user does not exist in the table kindly insert
		$insert = "INSERT INTO upload_status (matric_num,student_tbl_id,roles_id,roles,status,admin_id,admin_name) VALUES (:matric_num,:student_tbl_id,:roles_id,:roles,:status,:admin_id,:admin_name)";
        $stmtw = $conn->prepare($insert);
        foreach ($_POST['customRadio1'] as $optNum => $option) {
		$result = explode('|', $option );
		$stmtw->execute([
		'matric_num' => $matric,
		'student_tbl_id' => $tbl_id,
		'roles_id' => $result[1],
		'roles' => $result[0],
		'status' => '',
		'admin_id' => '',
		'admin_name' => ''
		]);
		}	
		# update once request is made
		$data = [
		'student_matric' => $matric,
		'student_tbl_id' => $tbl_id,
		'status' => '2'
		];
		$sql = "UPDATE uploads SET status = :status WHERE student_matric  = :student_matric AND student_tbl_id = :student_tbl_id";
		$stmtUp= $conn->prepare($sql);
		$stmtUp->execute($data);	

		#update the first row	
		$dataup = [
		'matric_num' => $matric,
		'student_tbl_id' => $tbl_id,
		'id' => '0',
		'status' => '1'
		];	
		addLimit($dataup);
		$_SESSION['success'] = ' success!. '.$matric." your request has been submitted please do not resubmit the request";	
		header('Refresh: 0; url=../student/dashboard?strings='.time());
	} catch(PDOException $e) {
		// echo $e->getMessage();die;
		$_SESSION['errors'] = ' an error has occured , please retry requesting the clearance ';
		header('location:../student/request');
	}
	# code...
}


if (isset($_POST['add_role']) && $_POST['add_role']=='add_role') {
	$role = $_POST['role'];
	$auth = $_POST['auth'];
	$office = $_POST['office'];
	$function = "admin with name  ".$full_name." has added ".$role." role " ;
	LoadUser($userid, $full_name, $admin_email, $function);
	try {
		$data = [
		'name' => $role,
		'creator_id' => $userid,
		'creator_name' => $full_name,
		'status' => '1',
		'auth' => $auth,
		'office' => $office,
		];
		$ins = "INSERT INTO roles (name,creator_id,creator_name,status,auth,office) VALUES (:name, :creator_id, :creator_name, :status,:auth,:office)";
		$stmt = $conn->prepare($ins);
		if ($stmt->execute($data) > 0) {
		$_SESSION['success'] = ' success!. '.$role.' has been added ato lists of roles ';
		}else{
		$_SESSION['errors'] = ' an error has occured , please retry adding '.$role . "role";
		}
		header('Refresh: 0; url=../admin/viewRoles.php?strings='.time());
	} catch(PDOException $e) {
		// echo $sql . "<br>" . $e->getMessage();die;
		$_SESSION['errors'] = ' an error has occured , please retry adding '.$role . "role";
		header('location:../admin/viewRoles.php');
	}
	# code...
}


if (isset($_POST['add_dept_from_form']) && $_POST['add_dept_from_form']=='add_dept_from_form') {
	$dept = $_POST['dept'];
	$function = "admin with name  ".$full_name." has added ".$dept." department " ;
	LoadUser($userid, $full_name, $admin_email, $function);
	try {
		$data = [
		'name' => $dept,
		'creator_id' => $userid,
		'creator_name' => $full_name,
		'status' => '1',
		];
		$insert = "INSERT INTO department (name,creator_id,creator_name,status) VALUES (:name,:creator_id,:creator_name,:status)ON DUPLICATE KEY UPDATE name = :name";
        $stmtw = $conn->prepare($insert);
		if ($stmtw->execute(['name' =>$dept,'creator_id' => $userid,'creator_name' => $full_name,'status' => '1']) > 0) {
		$_SESSION['success'] = ' success!. '.$dept.' has been added to the lists of department ';
		}else{
		$_SESSION['errors'] = ' an error has occured , please retry adding '.$dept . "department";
		}
		$_SESSION['uploaded_data'] = $data;
		header('location:../admin/dept.indiv.view.php?strings='.time());
	} catch(PDOException $e) {
		// echo $sql . "<br>" . $e->getMessage();die;
		$_SESSION['errors'] = ' an error has occured , please retry adding '.$dept . "department";
		header('location:../admin/addDeptForm.php');
	}
	# code...
}


if (isset($_POST['view_by_department']) && $_POST['view_by_department']=='view_by_department') {
	$dept = $_POST['department'];
	$function = "admin with name  ".$full_name." is viewing  ".$dept." students lists " ;
	LoadUser($userid, $full_name, $admin_email, $function);
	try {
		$stmt = $conn->prepare('SELECT * FROM students WHERE department = ? ORDER BY id desc');
		$stmt->execute([$dept]);
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		$data = $stmt->fetchAll();
		if($data == false){$data = ""; $_SESSION['errors'] = ' an error has occured , please retry viewing '.$dept . "students"; }else{
			$_SESSION['dataSel'] = $data;
			$_SESSION['success'] = ' success!. '.$dept.' has been fetched from the database ';
		}
	
		header('Refresh: 0; url=../admin/listStudent.php?strings='.time().'&data='.$dept);
	} catch(PDOException $e) {
		// echo $sql . "<br>" . $e->getMessage();die;
		$_SESSION['errors'] = ' an error has occured , please retry viewing  '.$dept . "students ";
		header('location:../admin/ViewByDept.php');
	}
	# code...
}


if (isset($_POST['add_individual_student']) && $_POST['add_individual_student']=='add_individual_student') {
	$matric_num = $_POST['matric_num'];
	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
	$emails = $_POST['email'];
	$dept = $_POST['department'];
	$passwordH = MD5(strtoupper($lastname));
	$password = crypt($passwordH,$passwordH);	
	
	try {
		$insert = "INSERT INTO students (username,firstname,lastname,email,matric_num,password,department,gender,phone_number,status,:img) VALUES (:username,:firstname,:lastname,:email,:matric_num,:password,:department,:gender,:phone_number,:status,:img)ON DUPLICATE KEY UPDATE matric_num = :matric_num";
          $stmtw = $conn->prepare($insert);
		if ($stmtw->execute(['username' => $matric_num,'firstname' => $firstname,'lastname' => $lastname,'email' => $emails,'matric_num' => $matric_num,'password' => $password,'department' => $dept,'gender' => '','phone_number' => '','status' => '','img' => '']) > 0) {
		$_SESSION['success'] = ' success!. '.$matric_num." of  ".$dept." department has been added to the student database";
		}else{
		$_SESSION['errors'] = ' an error has occured , please retry adding '.$matric_num." of  ".$dept." department  to the student database";
		}
		$function = "admin with name  ".$full_name." has added ".$matric_num." of  ".$dept." department to the student table" ;
		LoadUser($userid, $full_name, $admin_email, $function);
		$stmt = $conn->prepare('SELECT * FROM students WHERE username=? AND matric_num = ?');
		$stmt->execute([$matric_num, $matric_num]);
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		$user = $stmt->fetch();
		$_SESSION['studentJoin'] = $user;
		header('location:../admin/viewIdividual?strings='.time());
	} catch(PDOException $e) {
		// echo $e->getMessage();
		$_SESSION['errors'] = ' an error has occured , please retry adding '.$matric_num." of  ".$dept." department  to the student database";
		header('location:../admin/student.add');
	}
}


if(isset($_GET['strings']) && $_GET['params']=='individualStudent'){
		$id = $_GET['strings'];
		$stmt = $conn->prepare('SELECT * FROM students WHERE id=? ');
		$stmt->execute([$id]);
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		$user = $stmt->fetch();
		$_SESSION['studentJoin'] = $user;
		header('location:../admin/viewIdividual?strings='.time());
}

if(isset($_GET['strings']) && $_GET['params']=='ClearStudent'){
		$Student_ID = $_GET['data'];

		#select the student again
		$stmt = $conn->prepare('SELECT * FROM students WHERE id=? ');
		$stmt->execute([$Student_ID]);
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		$user = $stmt->fetch();
		$_SESSION['success'] = ' success!. student has been cleared by you ';
		$_SESSION['studentJoin'] = $user;
		header('location:../admin/viewIdividual?strings='.time());
}

if (isset($_GET['strings']) && $_GET['val']=='AdEd') {
	$adminID = $_GET['strings'];
	$fullname = $_GET['name'];
	$function = "admin with name  ".$full_name." has deleted ".$fullname." from admin" ;
	LoadUser($userid, $full_name, $admin_email, $function);
	$data = [
		'id' => $adminID,
		'username' => $fullname ,
		'status' => '0'
	];
	try {
		$sql = "UPDATE admin SET status = :status WHERE id  = :id AND username = :username";
		$stmt= $conn->prepare($sql);
		$stmt->execute($data);	
		if ($stmt->rowCount() > 0) {
		$_SESSION['success'] = ' success!. '.$fullname.' has been deleted from admin ';
		}else{
		$_SESSION['errors'] = ' an error has occured , please retry deleting '.$fullname .  "from lists of admin";
		}
		header('Refresh: 0; url=../admin/viewAdmin.php?strings='.time());
	} catch(PDOException $e) {
		// echo $sql . "<br>" . $e->getMessage();die;
		$_SESSION['errors'] = ' an error has occured , please retry deleting '.$fullname. "from lists of admin";
		header('location:../admin/addAdmin.php');
	}
	# code...
}

if (isset($_GET['strings']) && $_GET['params']=='vis') {
	$studentID = $_GET['strings'];
	$studentDept = $_GET['dept'];
	try {
		$function = "admin with name  ".$full_name." is viewing a student from ".$studentDept." department " ;
		LoadUser($userid, $full_name, $admin_email, $function);
		$stmt = $conn->prepare('SELECT * FROM students WHERE id=? AND department = ?');
		$stmt->execute([$studentID, $studentDept]);
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		$user = $stmt->fetch();
		$_SESSION['studentJoin'] = $user;
		if (!empty($user)) {
		$_SESSION['success'] = ' success!. the student has been retireved from database ';
		}else{
		$_SESSION['errors'] = ' an error has occured , please retry viewing the student rcords again';
		}
		header('Refresh: 0; url=../admin/viewIdividual.php?strings='.time());
	} catch(PDOException $e) {
		// echo $sql . "<br>" . $e->getMessage();die;
		$_SESSION['errors'] = ' an error has occured , please retry ';
		header('location:../admin/viewAllStudent.php');
	}
	# code...
}


if (isset($_GET['strings']) && $_GET['val']=='rolesd') {
	$roleid = $_GET['strings'];
	$creator_name = $_GET['name'];
	$rolename = $_GET['par'];
	$function = "admin with name  ".$full_name." has deleted ".$rolename." role that was created by ".$creator_name."from the role table" ;
	LoadUser($userid, $full_name, $admin_email, $function);
	$data = [
		'id' => $roleid,
		'creator_name' => $creator_name ,
		'status' => '0'
	];
	try {
		$sql = "UPDATE roles SET status = :status WHERE id  = :id AND creator_name = :creator_name";
		$stmt= $conn->prepare($sql);
		$stmt->execute($data);	
		if ($stmt->rowCount() > 0) {
		$_SESSION['success'] = ' success!. '.$rolename.' role has been deleted from roles table ';
		}else{
		$_SESSION['errors'] = ' an error has occured , please retry deleting '.$rolename  .  " role from lists of roles";
		}
		header('Refresh: 0; url=../admin/viewRoles.php?strings='.time());
	} catch(PDOException $e) {
		// echo $sql . "<br>" . $e->getMessage();die;
		$_SESSION['errors'] = ' an error has occured , please retry deleting '.$rolename. " role from lists of roles";
		header('location:../admin/viewRoles.php');
	}
	# code...
}

if (isset($_GET['strings']) && $_GET['val']=='DAdEd') {
	$id = $_GET['strings'];
	$department = $_GET['name'];
	$function = "admin with name  ".$full_name." has deleted ".$department." department from the system" ;
	LoadUser($userid, $full_name, $admin_email, $function);
	$data = [
		'id' => $id,
		'name' => $department,
		'status' => '0'
	];
	try {
		$sql = "UPDATE department SET status = :status WHERE id  = :id AND name = :name";
		$stmt= $conn->prepare($sql);
		$stmt->execute($data);	
		if ($stmt->rowCount() > 0) {
		$_SESSION['success'] = ' success!. '.$department.' department has been deleted from the system ';
		}else{
		$_SESSION['errors'] = ' an error has occured , please retry deleting '.$department  .  " department from the system";
		}
		header('Refresh: 0; url=../admin/viewDepartment.php?strings='.time());
	} catch(PDOException $e) {
		// echo $sql . "<br>" . $e->getMessage();die;
		$_SESSION['errors'] = ' an error has occured , please retry deleting '.$department. " department from the system";
		header('location:../admin/viewDepartment.php');
	}
	# code...
}

function SaveUploads($data,$dataupdate){
	global $conn;
	try {
		$insert = "INSERT INTO uploads (student_name,student_matric,student_tbl_id,file_name,status) VALUES (:student_name,:student_matric,:student_tbl_id,:file_name,:status)ON DUPLICATE KEY UPDATE student_matric = :student_matric";
        $stmtw = $conn->prepare($insert);
		if ($stmtw->execute($data) > 0) {
			$sql = "UPDATE students SET status = :status WHERE id  = :id AND matric = :matric";
			$stmt= $conn->prepare($sql);
			$stmt->execute($dataupdate);
			$stmt->rowCount();	
			return true;
		}else{return false;}
	} catch(PDOException $e) {
		// echo $sql . "<br>" . $e->getMessage();die;
		return false;
	}
}

function addLimit($dataup){
	global $conn;
	$up = "UPDATE upload_status SET status = :status WHERE matric_num  = :matric_num AND student_tbl_id = :student_tbl_id AND id > :id LIMIT 1";
	$Up= $conn->prepare($up);
	$Up->execute($dataup);
	return $Up->rowCount();
}