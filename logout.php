<?php 
	session_start();
	$_SESSION['reallyloggedin'] = false;
	$_SESSION['username'] = null;
	session_destroy();

	require('logged.php'); 
?>
