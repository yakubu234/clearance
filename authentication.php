<?php
include "classes/db.php";

if (isset($_POST['submit']) && $_POST['submit']=='Sign In') {
	$username = $_POST['Username'];
	$uniqueid = $_POST['uniqueid'];
	$passwordH = MD5(strtoupper($_POST['password']));
	$password = crypt($passwordH,$passwordH);
	if (strpos($uniqueid, 'true') !== false) {
		try {
			$stmt = $conn->prepare('SELECT * FROM students WHERE username=? AND password = ?');
			$stmt->execute([$username, $password]);
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			$user = $stmt->fetch();
			if($user == false){
			$_SESSION['errors'] = "yor login details are not correct please check";
			header('Location:index');
			}
			$fullname =$user['firstname']." ".$user['lastname'];
			$function = "user with matric number  ".$user['username']." logged in to the student dashboard";
			LoadUser($user['id'], $fullname , $user['email'],$function);
			echo "<script>
			alert('Login Successful, Redirecting Now');
			</script>";
			$_SESSION["PData"] = json_encode($user);
			header('Refresh: 0; url=student/dashboard?strings='.time());
		} catch(PDOException $e) {
			// echo $sql . "<br>" . $e->getMessage();die;
			$_SESSION['errors'] = "Please login first";
			header('location:index');
		}
	}else{
		$_SESSION['errors'] = "captcha error";
		header('location:index');
	}
}

if (isset($_POST['submit_admin']) && $_POST['submit_admin']=='Sign In Admin') {
	$username = $_POST['Username'];
	$uniqueid = $_POST['uniqueid'];
	$passwordH = MD5(strtoupper($_POST['password']));
	$password = crypt($passwordH,$passwordH);
	if (strpos($uniqueid, 'true') !== false) {
		try {
			$stmt = $conn->prepare('SELECT * FROM admin WHERE username=? AND password = ? AND status != ?');
			$stmt->execute([$username, $password, '0']);
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			$user = $stmt->fetch();
			if($user == false){
			$_SESSION['errors'] = "yor login details are not correct please check";
			header('Location:home');
			}
			$fullname =$user['full_name'];
			$function = "user with username ".$user['username']." logged in to the admin dashboard";
			LoadUser($user['id'], $fullname , $user['email'],$function);
			echo "<script>
			alert('Login Successful, Redirecting Now');
			</script>";
			$_SESSION["PData"] = json_encode($user);
			header('Refresh: 0; url=admin/dashboard?strings='.time());
		} catch(PDOException $e) {
			// echo $sql . "<br>" . $e->getMessage();die;
			$_SESSION['errors'] = "Please login first";
			header('location:home');
		}
	}else{
		$_SESSION['errors'] = "captcha error";
		header('location:home');
	}
	# code...
}

if (empty($_POST)) {	
$_SESSION['errors'] = "Please login first";
header('location:index');
}
?>