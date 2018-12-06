<?php require('logged.php'); include('nav.php'); ?>

<html>	
	<head>
		<title>
			Take Your Time
		</title>
		<script src="script/jquery.js"></script>
		TIME IS RUNNING OUT <br>
		START SOME TASKS!
		<link rel="stylesheet" type="text/css" href="styles/main.css">	
	</head>
	<body>

		<div>
			
			<br>
			<p id="timestart"></p>
			<h1 id="timer"></h1>
			
			<form action='./processing?process=addtimer' method="post" onsubmit="return setEnd()">
				<?php 
					function toecho($task_ID, $task_name, $due_date, $time_needed, $time_spent){
						$ded = new DateTime($due_date);
						$timezone= "Asia/Manila";
						date_default_timezone_set($timezone);

						$due = $ded->diff(new DateTime());
						if ($due->invert == 0){
							echo '<div class=\'card\' style="background-color: #B34C4B;"><div class=\'container\'>';	
						}else if ($due->d == 0){
							echo '<div class=\'card\' style="background-color: #38AF5D;"><div class=\'container\'>';	
						}else {
							echo '<div class=\'card\'><div class=\'container\'>';	
						}
						
						echo '<div>';
						echo '<p class=\'taskname\'><input type="radio"required onClick=hideothers() name="task-id" value="'.$task_ID.'">'.$task_name."</p>";
						echo "<p class='duedate'>Due: ".$due_date."</p>";
						echo "<p class='timeneeded'>Required: ".gmdate("H:i:s", $time_needed)."</p>";
						echo "<p class='timespent'>Done: ".gmdate("H:i:s", $time_spent)."</p>";
						echo '</div><div class=\'right\'>';

						echo "<p class='timerem'>".gmdate("H:i:s", $time_needed-$time_spent)."</p>";
						echo "<p class='timeremsec'>".strval($time_needed-$time_spent)."</p>";
						echo '</div>';
						echo '</div></div><br>';
					}

					$conn=mysqli_connect("localhost","root","root","takeyourtime");
	
					if (!$conn)
					  	die("Connection error: " . mysqli_connect_error());
					
					$query = "SELECT Tasks.task_ID, task_name, time_needed, due_date, time_spent FROM Tasks,todo WHERE status=0 AND Tasks.task_ID=todo.task_ID AND user_ID=".$_SESSION['user_id']." ORDER BY due_date;";
					$result = $conn->query($query);
					if ($result->num_rows == 0){
						echo "<p>Congratulations! You have no ongoing tasks.</p>";
						echo "<p>Start some tasks <a href='./createtasks'>here</a>.<p>";
					}
					foreach ($result as $row)	toecho($row['task_ID'], $row['task_name'], $row['due_date'], $row['time_needed'], $row['time_spent']);

				?>

				<input type="hidden" name="task-status" id="task_status" value="0" />
				<input type="hidden" name="time-start" id="time_start" />
				<input type="hidden" name="time-end" id="time_end" />
				<input type="hidden" name="duration" id="duration" />
				<input type="submit" id="end-timer" value="End timer" style="visibility:hidden;"/>

			</form>
			
		</div>

	</body>

	

	<script>
	var sec = 0;

		function setEnd(){
			document.getElementById("time_end").value = new Date().getTime();
			document.getElementById("duration").value = sec;
			var fin = confirm("TASK DONE?");
			if (fin == true)	document.getElementById("task_status").value = 1;
		}

		function hideothers(){
			document.title = "Doing Tasks [RUNNING]";
			var radios = document.getElementsByName('task-id');
			var unhidden = 0;
			for (var i = 0, length = radios.length; i < length; i++){
				 if (!radios[i].checked){
					radios[i].parentNode.parentNode.parentNode.parentNode.hidden = true;
				} else unhidden = i;			
			}
			document.getElementById("time_start").value = new Date().getTime();
			document.getElementById("end-timer").style.visibility = "visible";
				runtime = setInterval(function(){
						// radios[unhidden].parentNode.parentNode.style.backgroundColor = "red";
						// radios[unhidden].parentNode.parentNode.style.color = "white";

						// radios[unhidden].parentNode.parentNode.parentNode.lastElementChild.style.color = "#3c4158";
						// radios[unhidden].parentNode.parentNode.parentNode.lastElementChild.style.fontSize = "18px";			
						// radios[unhidden].parentNode.parentNode.parentNode.lastElementChild.style.fontWeight = "bold";	
						var hms1 = radios[unhidden].parentNode.parentNode.parentNode.lastElementChild.firstElementChild.innerHTML;
						// alert(hms1);
						var a1 = hms1.split(':'); // split it at the colons
						var seconds1 = (+a1[0]) * 60 * 60 + (+a1[1]) * 60 + (+a1[2]); 

						var seconds2 = parseInt(radios[unhidden].parentNode.parentNode.parentNode.lastElementChild.lastElementChild.innerHTML);
						radios[unhidden].parentNode.parentNode.parentNode.lastElementChild.lastElementChild.innerHTML = seconds2 - 1 + " seconds remaining";

						seconds1 = seconds1-1;
						hms1 = Math.floor((seconds1 / (60 * 60)) % 24);
						min1 = Math.floor((seconds1 / (60)) % 60);
						sec1 = seconds1 % 60;
						hms1 = (hms1 < 10) ? '0'+hms1:hms1;
						min1 = (min1 < 10) ? '0'+min1:min1;
						sec1 = (sec1 < 10) ? '0'+sec1:sec1;

						// unique = radios[unhidden].parentNode.parentNode.childNodes[5].innerHTML;
						// radios[unhidden].parentNode.parentNode.childNodes[5].innerHTML = unique-1;
						

						if (seconds1 > 0){
							seconds2 = seconds2-1;
							hms2 = Math.floor((seconds2 / (60 * 60)) % 24);
							min2 = Math.floor((seconds2 / (60)) % 60);
							sec2 = seconds2 % 60;
							hms2 = (hms2 < 10) ? '0'+hms2:hms2;
							min2 = (min2 < 10) ? '0'+min2:min2;
							sec2 = (sec2 < 10) ? '0'+sec2:sec2;
						}else{hms2='00';min2="00";sec2="00";}

						// radios[unhidden].parentNode.parentNode.childNodes[3].innerHTML = hms1+':'+min1+':'+sec1;

						radios[unhidden].parentNode.parentNode.parentNode.lastElementChild.firstElementChild.innerHTML= hms1+':'+min1+':'+sec1;
						// radios[unhidden].parentNode.parentNode.childNodes[4].innerHTML = hms2+':'+min2+':'+sec2;
				
						
						// var now = new Date().getTime();
						sec++;
						
						// var days = Math.floor(sec / (60 * 60 * 24));
					 //    var hours = Math.floor((sec / (60 * 60)) % 24);
					 //    var minutes = Math.floor((sec/60) % 60);
					 //    var seconds = sec % 60;
					    
					    // document.getElementById("timer").innerHTML = days + "d " + hours + "h "
					    // + minutes + "m " + seconds + "s ";
					}, 1000);
		

		}
		

		
	</script>
</html>
