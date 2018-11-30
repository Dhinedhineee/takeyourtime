<!DOCTYPE html>
<html>	
	<head>
	<title>Doing Tasks</title>
		<script src="script/jquery.js"></script>
	TIME IS RUNNING OUT <br>
	START SOME TASKS!
			<link rel="stylesheet" type="text/css" href="styles/main.css">	
	</head>	

	
	<body>
		<div>
			<a href='./createtasks.php'>CREATE NEW TASK</a>
		</div>

		<div>
			
			<br>
			<p id="timestart"></p>
			<h1 id="timer"></h1>
			
			<button type="button" id="but-timer" onClick=startTimer() style="height:100px; width:200px; background-color:red; color:white;">START NOW</button>
			<form action='./addtimer.php' method="post" onsubmit="return setEnd()">
				<!-- <button type="button" id="but-timer-end">END NOW</button> !-->
				<?php 
					

					function toecho($task_ID, $task_name, $due_date, $time_needed, $time_spent){
						echo '<tr>';
						echo '<td><input type="radio"required name="task-id" value="'.$task_ID.'">'.$task_name."<br/></td>";
						echo '<td align="center">'.$due_date.'</td>';
						echo '<td align="center">'.gmdate("H:i:s", $time_needed).'</td>';
						echo '<td align="center">'.gmdate("H:i:s", $time_spent).'	</td>';
						echo '<td align="center">'.gmdate("H:i:s", $time_needed-$time_spent).'</td>';
						echo '<td align="center">'.strval($time_needed-$time_spent)	.'</td>';
						echo '</tr>';
					}

					$conn=mysqli_connect("localhost","root","root","takeyourtime");
	
					if (!$conn)
					  	die("Connection error: " . mysqli_connect_error());
					
					$query = "SELECT task_ID, task_name, time_needed, due_date, time_spent FROM Tasks WHERE status=0 ORDER BY due_date;";
					$result = $conn->query($query);
					echo '<table border="1">';
					echo '<th>Tasks</th><th>Deadline</th><th>Required</th><th>Done</th><th>Remaining</th><th>REM</th>';
					foreach ($result as $row)	toecho($row['task_ID'], $row['task_name'], $row['due_date'], $row['time_needed'], $row['time_spent']);
					echo '</table>';

				?>
				<!-- <p id="test"> <label>Insert Project Name
					<input type="text" required name="task-name" id="task-name"/>
				</label></p> !-->
				<input type="hidden" name="task-status" id="task_status" value="0" />
				<input type="hidden" name="time-start" id="time_start" />
				<input type="hidden" name="time-end" id="time_end" />
				<input type="hidden" name="duration" id="duration" />
				<input type="submit" value="End timer" style="height:100px; width:200px; background-color:green; color:white;" />

			</form>
			
		</div>

	</body>

	

	<script>
	var sec = 0;
		function startTimer(){
			if (document.getElementById("but-timer").innerHTML == "START NOW"){

				document.getElementById("time_start").value = new Date().getTime();
				document.getElementById("timestart").innerHTML += "START TIME: " + Date() + "<br>";
				document.getElementById("but-timer").innerHTML = "STOP TIMER";

				runtime = setInterval(function(){
						var radios = document.getElementsByName('task-id');
						for (var i = 0, length = radios.length; i < length; i++){
						 if (radios[i].checked){
								// do whatever you want with the checked radio
								radios[i].parentNode.parentNode.style.backgroundColor = "red";
								radios[i].parentNode.parentNode.style.color = "white";
								var hms1 = radios[i].parentNode.parentNode.childNodes[3].innerHTML;
								var a1 = hms1.split(':'); // split it at the colons
								var seconds1 = (+a1[0]) * 60 * 60 + (+a1[1]) * 60 + (+a1[2]); 

								var hms2 = radios[i].parentNode.parentNode.childNodes[4].innerHTML;
								var a2 = hms2.split(':'); // split it at the colons
								var seconds2 = (+a2[0]) * 60 * 60 + (+a2[1]) * 60 + (+a2[2]); 

								seconds1 = seconds1+1;
								hms1 = Math.floor((seconds1 / (60 * 60)) % 24);
								min1 = Math.floor((seconds1 / (60)) % 60);
								sec1 = seconds1 % 60;
								hms1 = (hms1 < 10) ? '0'+hms1:hms1;
								min1 = (min1 < 10) ? '0'+min1:min1;
								sec1 = (sec1 < 10) ? '0'+sec1:sec1;

								unique = radios[i].parentNode.parentNode.childNodes[5].innerHTML;
								radios[i].parentNode.parentNode.childNodes[5].innerHTML = unique-1;
								
								if (unique > 0){
									seconds2 = seconds2-1;
									hms2 = Math.floor((seconds2 / (60 * 60)) % 24);
									min2 = Math.floor((seconds2 / (60)) % 60);
									sec2 = seconds2 % 60;
									hms2 = (hms2 < 10) ? '0'+hms2:hms2;
									min2 = (min2 < 10) ? '0'+min2:min2;
									sec2 = (sec2 < 10) ? '0'+sec2:sec2;
								}else{hms2='00';min2="00";sec2="00";}

								radios[i].parentNode.parentNode.childNodes[3].innerHTML = hms1+':'+min1+':'+sec1;
								radios[i].parentNode.parentNode.childNodes[4].innerHTML = hms2+':'+min2+':'+sec2;
								
							  break;
						 }
						}
						
						var now = new Date().getTime();
						sec++;
						
						var days = Math.floor(sec / (60 * 60 * 24));
					    var hours = Math.floor((sec / (60 * 60)) % 24);
					    var minutes = Math.floor((sec/60) % 60);
					    var seconds = sec % 60;
					    
					    document.getElementById("timer").innerHTML = days + "d " + hours + "h "
					    + minutes + "m " + seconds + "s ";
					}, 1000);
			}
			else{
				document.getElementById("but-timer").innerHTML = "START NOW";
				clearInterval(runtime)
			}
		}
		
		function setEnd(){
			document.getElementById("time_end").value = new Date().getTime();
			document.getElementById("duration").value = sec;
			var fin = confirm("TASK DONE?");
			if (fin == true)	document.getElementById("task_status").value = 1;
		}
		
	</script>
</html>
