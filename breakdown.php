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
		<form action="/takeyourtime/addbreakdowns.php" method="post" enctype="multipart/form-data">
			
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
					
					$query = "SELECT task_ID, task_name FROM Tasks;";
					$result = $conn->query($query);
					echo '<table border="1" style="display:inline-block;">';
					echo '<th>Tasks Parent</th>';
					foreach ($result as $row)	toecho($row['task_ID'], $row['task_name']);
					echo '</table>';

					$query = "SELECT task_ID, task_name FROM Tasks;";
					$result = $conn->query($query);
					echo '<table border="1" style="display:inline-block;">';
					echo '<th>Tasks Child</th>';
					foreach ($result as $row)	toecho2($row['task_ID'], $row['task_name']);
					echo '</table>';
				?>
			
		<br>
	  	<input type="submit" value="Submit">
	</form>
	</div>

	</body>
</html>