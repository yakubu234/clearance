<?php
include "../classes/db.php";
include "geter.php";
$getterID = $_GET['checker'];
$conn->prepare("DELETE FROM students WHERE id = ?")->execute([$getterID]);
$conn->prepare("DELETE FROM uploads WHERE student_tbl_id = ?")->execute([$getterID]);
$conn->prepare("DELETE FROM upload_status WHERE student_tbl_id = ?")->execute([$getterID]);

$_SESSION['success'] = " Upload successful, here are your uploads";
header('location:viewIdividual?strings='.time());
?>