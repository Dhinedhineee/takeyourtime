<?php
	function getTS($sec){
		return date("Y-m-d H:i:s", substr($sec, 0, 10));
	}

	$conn=mysqli_connect("localhost","root","root","takeyourtime");
	
	if (!$conn)
	  	die("Connection error: " . mysqli_connect_error());
		
	
	$name = $_POST['task-name'];
	$hours = ($_POST['task-hours-hr']*60*60) + ($_POST['task-hours-min']*60);
	
	var_dump($_POST['task-deadline']);
	$deadline = getTS(strtotime($_POST['task-deadline']));
	var_dump($deadline);

	$query = "INSERT INTO Tasks (task_name, due_date, time_needed) VALUES ('$name','$deadline
		','$hours');";
	var_dump($query);
	$result = $conn->query($query);
	var_dump($result);

	$task_ID = mysqli_insert_id($conn);
	

	$query = "INSERT INTO Todo (user_ID, task_ID) VALUES (1, '$task_ID')";
	var_dump($query);
	$result = $conn->query($query);
	var_dump($result);



	$conn->close();		
	redirect('/takeyourtime/tasks');
	function redirect($url){
		$string = '<script type="text/javascript">';
	    $string .= 'setTimeout(function(){window.location = "' . $url . '";}, 5);';
	    $string .= '</script>';
	    echo $string;
	    die();
	}
?>
