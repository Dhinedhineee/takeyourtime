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
		<h2> LABEL TASKS </h2>

		<div id='AddTasks'>
			<form action="./processing?process=addtags" method="post" enctype="multipart/form-data">
				
				<?php 
						function toecho($task_ID, $task_name){
							echo '<tr>';
							echo '<td><input type="radio"required name="task-id" value="'.$task_ID.'">'.$task_name."<br/></td>";
							echo '</tr>';
						}

						function toecho2($label_ID, $label_name){
							echo '<tr>';
							echo '<td><input type="radio" required name="label-id" value="'.$label_ID.'">'.$label_name."<br/></td>";
							echo '</tr>';
						}

						$conn=mysqli_connect("localhost","root","root","takeyourtime");
		
						if (!$conn)
						  	die("Connection error: " . mysqli_connect_error());
						
						
						$query = "SELECT DISTINCT labels.label_ID, label_name FROM Labels, groups, user WHERE Labels.label_ID = groups.label_ID AND groups.user_ID=".$_SESSION['user_id'];
						$result = $conn->query($query);
						
						if ($result->num_rows != 0){
							echo '<table border="1" style="display:inline-block;">';
							echo '<th>Labels</th>';			
							foreach ($result as $row)	toecho2($row['label_ID'], $row['label_name']);
							
							echo '</table>';
							$query = "SELECT Tasks.task_ID, task_name FROM Tasks,todo WHERE status=0 AND Tasks.task_ID=todo.task_ID AND user_ID=".$_SESSION['user_id'];
							$result = $conn->query($query);
							echo '<table border="1" style="display:inline-block;">';
							echo '<th>Tasks</th>';
							foreach ($result as $row)	toecho($row['task_ID'], $row['task_name']);
							echo '</table>';
						} else {
							echo "<p>You have not yet created any labels yet.</p>";
							echo "<p>Add some labels <a href='./createlabels'>here</a>.<p>";
						}
					?>
				
			<br>
		  	<input type="submit" value="Submit">
		</form>
		</div>

	</body>
</html>
