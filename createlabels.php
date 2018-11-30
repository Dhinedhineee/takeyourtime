
<html>
	<title>
		Take Your Time
	</title>

	<body>
	<h1> It's Time to Take Your Time </h1>
	<h2> CREATE LABELS </h2>

	<div id='AddTasks'>
		<form action="/takeyourtime/addlabels.php" method="post" enctype="multipart/form-data">
		<h4>Add labels</h4>
		<p>	
		<label>Label Name<br>
			<input type="text" required name="label-name" size="40" id="task-name"/>
		</label>
		</p>
		
	  	<input type="submit" value="Submit">
	</form>
	</div>

	</body>
</html>