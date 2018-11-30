<html>
<head>
	<title>
		Tag Me
	</title>
		<link rel="stylesheet" type="text/css" href="styles/main.css">	

</head>
	
	<body>
	<h1> It's Time to Take Your Time </h1>
	<h2> TAG TASKS </h2>

	<div id='AddTasks'>
		<form action="/takeyourtime/addtags.php" method="post" enctype="multipart/form-data">
			
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
					
					
					echo '<table border="1" style="display:inline-block;">';
					echo '<th>Tags</th>';
					$query = "SELECT label_ID, label_name FROM Labels";
					$result = $conn->query($query);
					foreach ($result as $row)	toecho2($row['label_ID'], $row['label_name']);
					echo '</table>';

					$query = "SELECT task_ID, task_name FROM Tasks;";
					$result = $conn->query($query);
					echo '<table border="1" style="display:inline-block;">';
					echo '<th>Tasks</th>';
					foreach ($result as $row)	toecho($row['task_ID'], $row['task_name']);
					echo '</table>';
				?>
			
		<br>
	  	<input type="submit" value="Submit">
	</form>
	</div>

	</body>
</html>