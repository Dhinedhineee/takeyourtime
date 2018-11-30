<?php

	$conn=mysqli_connect("localhost","root","root","takeyourtime");
	
	if (!$conn)
	  	die("Connection error: " . mysqli_connect_error());
		
	
	$task_ID = $_POST['task-id'];
	$label_ID = $_POST['label-id'];

	$query = "INSERT INTO Tag (label_ID, task_ID) VALUES ('$label_ID', '$task_ID')";
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
