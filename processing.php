
<?php
	if (isset($_GET["process"]))
		$task = htmlspecialchars($_GET["process"]);
	else
		redirect('/takeyourtime');

	if ($task != 'userlogin' && $task != 'adduser'){
		require('logged.php');
	}

	$conn=mysqli_connect("localhost","root","root","takeyourtime");
	
	if (!$conn)
	  	die("Connection error: " . mysqli_connect_error());

	switch ($task) {
		case 'addachievements':
			$name = htmlspecialchars($_POST['ach-name']);
			$desc = htmlspecialchars($_POST['ach-desc']);
			$exp = (int)htmlspecialchars($_POST['ach-exp']);
			$query = "INSERT INTO Achievements (ach_name, description, exp_value) VALUES ('$name', '$desc', $exp);";
			var_dump($desc);
			var_dump($query);
			$result = $conn->query($query);
			var_dump($result);
				break;

		case 'addbreakdowns':
			$task_ID1 = htmlspecialchars($_POST['task-id1']);
			$task_ID2 = htmlspecialchars($_POST['task-id2']);
			$query = "INSERT INTO Breakdown (task_ID1, task_ID2) VALUES ('$task_ID1', '$task_ID2')";
			var_dump($query);
			$result = $conn->query($query);
			var_dump($result);
			break;

		case 'addlabels':
			$name = htmlspecialchars($_POST['label-name']);
			$query = "INSERT INTO Labels (label_name) VALUES ('$name')";
			var_dump($query);
			$result = $conn->query($query);
			var_dump($result);

			$label_ID = mysqli_insert_id($conn);
			
			$query = "INSERT INTO Groups (user_ID, label_ID) VALUES ('".$_SESSION['user_id']."', '$label_ID')";
			var_dump($query);
			$result = $conn->query($query);
			var_dump($result);
			break;

		case 'addtags':
			$task_ID = htmlspecialchars($_POST['task-id']);
			$label_ID = htmlspecialchars($_POST['label-id']);

			$query = "INSERT INTO Tag (label_ID, task_ID) VALUES ('$label_ID', '$task_ID')";
			var_dump($query);
			$result = $conn->query($query);
			var_dump($result);
			break;

		case 'addtasks':
			$name = htmlspecialchars($_POST['task-name']);
			$hours = ($_POST['task-hours-hr']*60*60) + ($_POST['task-hours-min']*60);
			
			var_dump(htmlspecialchars($_POST['task-deadline']));
			$deadline = getTS(strtotime(htmlspecialchars($_POST['task-deadline'])));
			var_dump($deadline);

			$query = "INSERT INTO Tasks (task_name, due_date, time_needed) VALUES ('$name','$deadline
				','$hours');";
			var_dump($query);
			$result = $conn->query($query);
			var_dump($result);

			$task_ID = mysqli_insert_id($conn);
			
			$query = "INSERT INTO Todo (user_ID, task_ID) VALUES ('".$_SESSION['user_id']."', '$task_ID')";
			var_dump($query);
			$result = $conn->query($query);
			var_dump($result);
			break;
		
		case 'addtimer':
			$timezone= "Asia/Manila";
			date_default_timezone_set($timezone);

			//$task_name = htmlspecialchars($_POST['task-name'];
			$task_ID = htmlspecialchars($_POST['task-id']);
			$time_start = getTS(htmlspecialchars($_POST['time-start']));
			$time_end = getTS(htmlspecialchars($_POST['time-end']));
			$duration = htmlspecialchars($_POST['duration']+1);
			$status = htmlspecialchars($_POST['task-status']);


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
			break;

		case 'adduserachievements':
			$user_ID = htmlspecialchars($_POST['user-ID']);
			$ach_ID = htmlspecialchars($_POST['ach-ID']);

			$query = "INSERT INTO achieved (user_ID, ach_ID) VALUES ('$user_ID', '$ach_ID')";
			var_dump($query);
			$result = $conn->query($query);
			var_dump($result);
			break;

		case 'adduser':
			$name = htmlspecialchars($_POST['user-name']);
			$pw = hash('sha512', htmlspecialchars($_POST['user-pw']));
			$query = "INSERT INTO User (user_name, password) VALUES ('$name', '$pw');";
			$result = $conn->query($query);
			session_start();
			$_SESSION['reallyloggedin'] = true;
			$_SESSION['username'] = $name;
			$_SESSION['user_id'] = mysqli_insert_id($conn);
			break;

		case 'userlogin':
			$name = htmlspecialchars($_POST['user-name']);
			$pw = hash('sha512', htmlspecialchars($_POST['user-pw']));
			$query = "SELECT user_id FROM User WHERE user_name='$name' AND password='$pw';";
			$result = $conn->query($query);
			if($result->num_rows == 1){	
				session_start();
				$_SESSION['reallyloggedin'] = true;
				$_SESSION['username'] = $name;	
				$_SESSION['user_id'] = mysqli_fetch_row($result)[0];
			}
			break;

		default:
			# code...
			break;
	}


	$conn->close();
	redirect('/takeyourtime');

	function redirect($url){
		$string = '<script type="text/javascript">';
	    $string .= 'setTimeout(function(){window.location = "' . $url . '";}, 5);';
	    $string .= '</script>';
	    echo $string;
	    die();
	}

	function getTS($sec){
		return date("Y-m-d H:i:s", substr($sec, 0, 10));
	}	
?>

