<?php require('logged.php'); include('nav.php'); ?>

<html>
	<head>
	<title>
		Tag Me
	</title>
			<link rel="stylesheet" type="text/css" href="styles/main.css">	
	</head>

	<body>
		<h1> It's Time to Take Your Time </h1>
		<h2> BREAKDOWN TASKS </h2>

		<div id='AddTasks'>
			<form action="./processing?process=addbreakdown" method="post" enctype="multipart/form-data">	
				<?php 
						function toecho($task_ID, $task_name){
							echo '<tr>';
							echo '<td><input type="radio"required name="task-id1" value="'.$task_ID.'">'.$task_name."<br/></td>";
							echo '</tr>';
						}

						function toecho2($task_ID, $task_name){
							echo '<tr>';
							echo '<td><input type="radio"required name="task-id2" value="'.$task_ID.'">'.$task_name."<br/></td>";
							echo '</tr>';
						}


						$conn=mysqli_connect("localhost","root","root","takeyourtime");
		
						if (!$conn)
						  	die("Connection error: " . mysqli_connect_error());
						
						$query = "SELECT Tasks.task_ID, task_name FROM Tasks,todo WHERE status=0 AND Tasks.task_ID=todo.task_ID AND user_ID=".$_SESSION['user_id'];
						$result = $conn->query($query);
						if ($result->num_rows == 0){
							echo "<p>You have not yet created any tasks.</p>";
							echo "<p>Start some tasks <a href='./createtasks'>here</a>.<p>";
						}else {
							echo '<table border="1" style="display:inline-block;">';
							echo '<th>Tasks Parent</th>';
							foreach ($result as $row)	toecho($row['task_ID'], $row['task_name']);
							echo '</table>';

							$query = "SELECT Tasks.task_ID, task_name FROM Tasks,todo WHERE status=0 AND Tasks.task_ID=todo.task_ID AND user_ID=".$_SESSION['user_id'];
					
							$result = $conn->query($query);
							echo '<table border="1" style="display:inline-block;">';
							echo '<th>Tasks Child</th>';
							foreach ($result as $row)	toecho2($row['task_ID'], $row['task_name']);
							echo '</table>';
						}

					?>
				
			<br>
		  	<input type="submit" value="Submit">
		</form>
		</div>

	</body>
</html>
