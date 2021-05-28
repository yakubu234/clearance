<?php
error_reporting(E_ALL);

include "classes/api.php";


$SERVER = $servername;
$USER = $username;
$PASSWORD = $password;
$dbname = $dbname;

//_dbx is my connection variable
$_dbx = new mysqli ($SERVER,$USER,$PASSWORD);

//Checking Connection
if ($_dbx->connect_error){
	echo "Connection not detected".$_dbx->connect_error;
}

//we create the database with the following command;
$database_sql = "CREATE DATABASE IF NOT EXISTS $dbname";
// $database_sql = "CREATE DATABASE IF NOT EXISTS '$dbname'";
if ($_dbx->query($database_sql) === FALSE){
	return true;
}

$new_connection =  new mysqli ($SERVER,$USER,$PASSWORD,$dbname);
//////////////////////////////////////////

?>