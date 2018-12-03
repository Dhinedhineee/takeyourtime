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
	<h2> REGISTRATION </h2>

	<div id='AddTasks'>
		<form action="./processing?process=adduser" method="post" enctype="multipart/form-data">
		<h4>Register</h4>
		
		<p><label>User Name<br>
			<input type="text" required name="user-name" size="40" id="user-name"/>
		</label></p>

		<p><label>Password<br>
			<input type="password" required name="user-pw" size="40" id="user-pw"/>
		</label></p>

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