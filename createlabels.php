<?php require('logged.php'); ?>

<html>
	<head>
		
	<title>
		Take Your Time
	</title>
			<link rel="stylesheet" type="text/css" href="styles/main.css">	
<script src="script/jquery-1.10.2.js"></script>
	</head>
	<body>

	<div id="nav-placeholder"></div>
	
	<h1> It's Time to Take Your Time </h1>
	<h2> CREATE LABELS </h2>

	<div id='AddTasks'>
		<form action="./processing?process=addlabels" method="post" enctype="multipart/form-data">
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

<script>
	$(function(){
	  $("#nav-placeholder").load("nav.html");
	});
</script>