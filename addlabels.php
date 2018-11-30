<?php

	$conn=mysqli_connect("localhost","root","root","takeyourtime");
	
	if (!$conn)
	  	die("Connection error: " . mysqli_connect_error());
		
	
	$name = $_POST['label-name'];
	$query = "INSERT INTO Labels (label_name) VALUES ('$name')";
	var_dump($query);
	$result = $conn->query($query);
	var_dump($result);

	$label_ID = mysqli_insert_id($conn);
	
	$query = "INSERT INTO Groups (user_ID, label_ID) VALUES (1, '$label_ID')";
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
