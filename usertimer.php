<?php require('logged.php'); include('nav.php'); ?>

<html>
<head>
	<title>User Timer</title>
	<link rel="stylesheet" type="text/css" href="styles/main.css">	
</head>
<body>
		<h2> TIMER LIST </h2>
	<form action='./processing?process=deletetask' method="post">
	<select id="task_list" name="task_list" onchange="showothers()">
	<?php
		$conn=mysqli_connect("localhost","root","root","takeyourtime");
	
		if (!$conn)
		  	die("Connection error: " . mysqli_connect_error());
						
		$query = "SELECT Tasks.task_ID, task_name FROM Tasks,todo WHERE Tasks.task_ID=todo.task_ID AND user_ID=".$_SESSION['user_id'];
					
		$result = $conn->query($query);
		
		if ($result->num_rows != 0){
			foreach ($result as $row){
				echo "<option value='".$row['task_ID']."'>".$row['task_name']."</option>";
			}
		} else {
			echo "<p>You have not yet created any tasks.</p>";
			echo "<p>Start some tasks <a href='./createtasks'>here</a>.<p>";
		}	
	?>
	</select>

	<input type="submit" id="delete-task" value="Delete Task" />
	</form>
	<?php
		$first = 0;
		foreach ($result as $row) {
			$query2 = "SELECT * FROM timer,done WHERE timer.timer_ID=done.timer_ID AND done.task_ID=".$row['task_ID'];
			$result2 = $conn->query($query2);
			foreach ($result2 as $row2){
				if ($first != 0) echo '<div class="card_timer" hidden><div class="container_timer">';
				else 			echo '<div class="card_timer"><div class="container_timer">';
				echo '<div class="times">
				<input type="radio" onclick=hideothers() name="task-time"/>
				<p class="time_start">'.$row2['time_start'].'</p>';
				echo '<p class="time_end">'.$row2['time_end'].'</p></div>';
				echo '<input type="hidden" name="task-hidden" value="'.$row['task_ID'].'"/>';	
				echo '<input type="hidden" name="timer-hidden" value="'.$row2['timer_ID'].'"/>';
				$days = floor($row2['duration'] / (60*60*24));
				$hours = floor(($row2['duration'] / (60*60))%24	);
				$mins = floor(($row2['duration']/60) % 60);
				$secs = floor($row2['duration'] % 60);

				$days = ($days < 10 ? "0":"").$days;
				$hours = ($hours < 10 ? "0":"").$hours;
				$mins = ($mins < 10 ? "0":"").$mins;
				$secs = ($secs < 10 ? "0":"").$secs;
					
				echo '<span class="duration">'.$days.':'.$hours.':'.$mins.':'.$secs.'</span>';
				echo '<input type="hidden" name="timerid" id="timerid" />';
				
				echo '</div></div>';
			}
			$first = 1;
		}
		
	?>		
	<button type="submit" id="delete-timer" hidden onclick="wait()">Delete Timer</button>
	</form>
	<p id="addtltext"></p>
	</body>
	<script>
		var unhidden = null;
		
		function wait(){
			var radios = document.getElementsByName('task-time');
			var val = radios[unhidden].parentNode.parentNode.childNodes[2].value;
			url = './processing?process=deletetimer&timerid=' + val + '&taskid=' + document.getElementById("task_list").value; 
			setTimeout(function(){window.location = url;}, 5);
		}

		function hideothers(){
			var radios = document.getElementsByName('task-time');
			unhidden = 0;
			for (var i = 0, length = radios.length; i < length; i++){
				 if (!radios[i].checked){
					radios[i].parentNode.parentNode.parentNode.hidden = true;
				} else unhidden = i;			
			}
			document.getElementById("delete-timer").hidden = false;
			
			// alert(document.getElementsByName);
		}


		function showothers(){
			var pickme = document.getElementsByName('task-hidden');
			// console.log("changed");
			var ctr = 0;
			for (var i = 0, length = pickme.length; i < length; i++){
				var luck = document.getElementById("task_list").value; 
				if (pickme[i].value == luck){
					pickme[i].parentNode.parentNode.hidden = false;
					ctr = 1;
				}
				else pickme[i].parentNode.parentNode.hidden = true;
			}
			if (ctr == 0) document.getElementById("addtltext").innerHTML = "No logged timers for this task.";
			else 		  document.getElementById("addtltext").innerHTML = "";
		}
		

		
	</script>


</html>