<?php

$db_host = 'localhost';
$db_name = 'lab8';
$username = 'root';
$password = '';

try {
	$conn = new PDO("mysql:dbname=$db_name;host=$db_host", $username, $password);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $ex) {
	echo("Failed to connect to the database.<br>");
	echo($ex->getMessage());
	exit;
}
?>
