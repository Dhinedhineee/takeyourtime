
<html>
	<title>
		Take Your Time
	</title>

	<body>
	<h1> It's Time to Take Your Time </h1>
	<h2> CREATE TASKS </h2>

	<div id='AddTasks'>
		<form action="/takeyourtime/addtasks.php" method="post" enctype="multipart/form-data">
		<h4>Add Tasks</h4>
		<p>	
		<label>Task Name<br>
			<input type="text" required name="task-name" size="40" id="task-name"/>
		</label>
		</p>

		<p><label>Task Deadline<br>
			<?php
				$mindate = date_default_timezone_set('Asia/Manila');
				$mindate = date('Y-m-d').'T'.date('H:i');
				echo '
				<input type="datetime-local" name="task-deadline" id="task-deadline"  required min="'.$mindate.'" value="'.$mindate.'"/>';
			?>
			<!-- <input type="time" name="task-deadline-time" id="task-deadline-time" value="00:00"/> !-->
		</label></p>

		<p><label>Task Hours<br>
			<input type="number" name="task-hours-hr" value="0" min="0" size="10"/>
			<input type="number" name="task-hours-min" value="0" min="0" max="59"/>
		</label></p>

		
	  	<input type="submit" value="Submit">
	</form>
	</div>

	</body>
</html>