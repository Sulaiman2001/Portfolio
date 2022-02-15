<?php
	//step 1: start the session, check if the user is not logged in, redirect to start
	session_start();

	if (!isset($_SESSION['email'])){
		header("Location: index.php");
		exit();
	}
	function Welcome(){
	$email=$_SESSION['email'];
	echo "Welcome ".$_SESSION['email']."! ";
}
	// Step2. include the connectdb.php to connect to the database, the PDO object is called $db and run the query to get all the course information
	require_once ('connectdb.php');
?>
