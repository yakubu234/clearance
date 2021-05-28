<?php

function generateAllStudent(){
	$conn = DB();
	try {
		global $data;
		$stmt = $conn->prepare('SELECT * FROM students ORDER BY department asc');
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		$data = $stmt->fetchAll();
		if($data == false){$data = "";}
	} catch(PDOException $e) {
		// echo $sql . "<br>" . $e->getMessage();
	}
	return $data;
}


function getLog(){
	$conn = DB();
	try {
		global $data;
		$stmt = $conn->prepare('SELECT * FROM GetData ORDER BY id desc');
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		$data = $stmt->fetchAll();
		if($data == false){$data = "";}
	} catch(PDOException $e) {
		// echo $sql . "<br>" . $e->getMessage();
	}
	return $data;
}

function getAdminList(){
	$conn = DB();
	try {
		global $data;
		$stmt = $conn->prepare('SELECT * FROM admin ORDER BY id desc');
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		$data = $stmt->fetchAll();
		if($data == false){$data = "";}
	} catch(PDOException $e) {
		// echo $sql . "<br>" . $e->getMessage();
	}
	return $data;
}

function getRoles(){
	$conn = DB();
	try {
		global $data;
		$stmt = $conn->prepare('SELECT * FROM roles WHERE status > "0" ORDER BY id desc');
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		$data = $stmt->fetchAll();
		if($data == false){$data = "";}
	} catch(PDOException $e) {
		// echo $sql . "<br>" . $e->getMessage();die;
	}
	return $data;
}

function getDepartment(){
	$conn = DB();
	try {
		global $data;
		$stmt = $conn->prepare('SELECT * FROM department WHERE status > "0" GROUP BY name asc');
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		$data = $stmt->fetchAll();
		if($data == false){$data = "";}
	} catch(PDOException $e) {
		// echo $sql . "<br>" . $e->getMessage();die;
	}
	return $data;
}

function getstudentByDept(){
	$conn = DB();
	try {
		global $data;
		$stmt = $conn->prepare('SELECT * FROM students GROUP BY department desc');
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		$data = $stmt->fetchAll();
		if($data == false){$data = "";}
	} catch(PDOException $e) {
		// echo $sql . "<br>" . $e->getMessage();die;
	}
	return $data;
}