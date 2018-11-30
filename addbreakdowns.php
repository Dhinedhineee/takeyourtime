<?php

	$conn=mysqli_connect("localhost","root","root","takeyourtime");
	
	if (!$conn)
	  	die("Connection error: " . mysqli_connect_error());
		
	
	$task_ID1 = $_POST['task-id1'];
	$task_ID2 = $_POST['task-id2'];

	$query = "INSERT INTO Breakdown (task_ID1, task_ID2) VALUES ('$task_ID1', '$task_ID2')";
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
