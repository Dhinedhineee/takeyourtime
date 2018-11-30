<?php

	$conn=mysqli_connect("localhost","root","root","takeyourtime");
	
	if (!$conn)
	  	die("Connection error: " . mysqli_connect_error());
		
	
	$user_ID = $_POST['user-ID'];
	$ach_ID = $_POST['ach-ID'];

	$query = "INSERT INTO achieved (user_ID, ach_ID) VALUES ('$user_ID', '$ach_ID')";
	var_dump($query);
	$result = $conn->query($query);
	var_dump($result);
	
	$conn->close();		

	redirect('/takeyourtime');
	
	function redirect($url){
		$string = '<script type="text/javascript">';
	    $string .= 'setTimeout(function(){window.location = "' . $url . '";}, 5);';
	    $string .= '</script>';
	    echo $string;
	    die();
	}
	
?>
