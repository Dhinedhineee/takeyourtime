<?php
	$conn=mysqli_connect("localhost","root","root","takeyourtime");
	
	if (!$conn)
	  	die("Connection error: " . mysqli_connect_error());
		

	$timezone= "Asia/Manila";
	date_default_timezone_set($timezone);

	//$task_name = $_POST['task-name'];
	$task_ID = $_POST['task-id'];
	$time_start = getTS($_POST['time-start']);
	$time_end = getTS($_POST['time-end']);
	$duration = $_POST['duration']+1;
	$status = $_POST['task-status'];


	var_dump($task_ID);
	var_dump($time_start);
	var_dump($time_end);
	var_dump($duration);

	$query = "INSERT INTO Timer(time_start, time_end, duration) VALUES ('$time_start', '$time_end', '$duration');";
	var_dump($query);
	$result = $conn->query($query);
	var_dump($result);
	$timer_ID = mysqli_insert_id($conn);
	$query = "INSERT INTO Done(task_ID, timer_ID) VALUES ('$task_ID', '$timer_ID');";
	var_dump($query);
	$result = $conn->query($query);
	var_dump($result);


	if ($status == 1){
		$query = "UPDATE Tasks SET status=1 WHERE task_ID=$task_ID;";
		var_dump($query);
		$result = $conn->query($query);
		var_dump($result);
		
	}


	$conn->close();

	function getTS($sec){
		return date("Y-m-d H:i:s", substr($sec, 0, 10));
	}

	redirect('/takeyourtime/tasks');
	function redirect($url){
		$string = '<script type="text/javascript">';
	    $string .= 'setTimeout(function(){window.location = "' . $url . '";}, 5);';
	    $string .= '</script>';
	    echo $string;
	    die();
	}

?>

