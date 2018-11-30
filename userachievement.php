<html>
	<head>
	<title>
		Achieve
	</title>
		<link rel="stylesheet" type="text/css" href="styles/main.css">		
		<script src="script/jquery-1.10.2.js"></script>
	</head>
	
	<body>

	<div id="nav-placeholder"></div>

	<h1> It's Time to Take Your Time </h1>
	<h2> ACHIEVEMENT TIME </h2>

	<div id='AddTasks'>
		<form action="/takeyourtime/adduserachievements.php" method="post" enctype="multipart/form-data">
			
			<?php 
					function toecho($task_ID, $task_name){
						echo '<tr>';
						echo '<td><input type="radio"required name="user-ID" value="'.$task_ID.'">'.$task_name."<br/></td>";
						echo '</tr>';
					}

					function toecho2($ach_ID, $ach_name, $exp_value, $description){
						echo '<tr>';
						echo '<td><input type="radio"required name="ach-ID" value="'.$ach_ID.'">'.$ach_name."<br/></td>";
						echo '<td>'.$exp_value.'</td>';
						echo '<td>'.$description.'</td>';
						echo '</tr>';
					}


					$conn=mysqli_connect("localhost","root","root","takeyourtime");
	
					if (!$conn)
					  	die("Connection error: " . mysqli_connect_error());
					
					$query = "SELECT user_ID, user_name FROM User;";
					$result = $conn->query($query);
					echo '<table border="1" style="display:inline-block;">';
					echo '<th>User</th>';
					foreach ($result as $row)	toecho($row['user_ID'], $row['user_name']);
					echo '</table>';

					$query = "SELECT ach_ID, ach_name, exp_value, description FROM achievements;";
					$result = $conn->query($query);
					echo '<table border="1" style="display:inline-block;">';
					echo '<th>Achievement</th><th>Exp</th><th>Description</th>';
					foreach ($result as $row)	toecho2($row['ach_ID'], $row['ach_name'], $row['exp_value'], $row['description']);
					echo '</table>';
				?>
			
		<br>
	  	<input type="submit" value="Submit">
	</form>
	</div>

	</body>
</html>

<script>
	$(function(){
	  $("#nav-placeholder").load("nav.html");
	});
</script>