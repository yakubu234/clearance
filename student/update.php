<?php

include "../classes/db.php"; 
if (!isset($_SESSION["PData"])) {
	$_SESSION['errors'] = "Please login first";
	header('location:../index');
}
include 'geter.php';
$storeFolder = '../uploads/passports';   //2 
 
if (!empty($_FILES) && $_FILES['img']['size'] < 410000) {
     
    $tempFile = $_FILES['img']['tmp_name'];          //3             
      
    $targetPath = dirname( __FILE__ ) .'/'. $storeFolder . '/';  //4
    $imgName =  rand().$username.strtoupper($lastname).basename($_FILES['img']['name']);
    $targetFile =  $targetPath. $imgName;  //5 
    move_uploaded_file($tempFile,$targetFile); //6

    $data = [
        'firstname' =>$_POST['firstname'],
        'lastname' => $_POST['lastname'],
        'email' => $_POST['email'],
        'department' => $_POST['department'],
        'gender' => $_POST['gender'],
        'phone_number' => $_POST['phone_number'],
        'img' => $imgName,
        'status' => '1',
        'matric_num' => $_POST['matric_num'],
        'id' => $userid,
    ];
	
	try {
		
        $sql = "UPDATE students SET firstname=:firstname, lastname=:lastname, email=:email, department=:department ,gender=:gender ,phone_number=:phone_number,img=:img,status=:status WHERE id=:id AND matric_num=:matric_num";
        $stmt= $conn->prepare($sql);
        $stmt->execute($data);
        $_SESSION['success'] = ' success!. '.$matric_num." of  ".$dept." department your profile has been updated. you can proceed to upload clearance";

		
		$stmt = $conn->prepare('SELECT * FROM students WHERE username=? AND matric_num = ?');
		$stmt->execute([$_POST['matric_num'], $_POST['matric_num']]);
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		$user = $stmt->fetch();
		$_SESSION['PData'] = json_encode($user);
        
		header('location:dashboard?strings='.time());
	} catch(PDOException $e) {
		// echo $e->getMessage();die;
		$_SESSION['errors'] = ' an error has occured '.$matric_num." of  ".$dept." department  please try again";
		header('location:dashboard');
	}
}else{
    echo "the size of your picture is much please checkout";
}
?>