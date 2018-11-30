
<html>
	<title>
		Take Your Time
	</title>

	<body>
	<h1> It's Time to Take Your Time </h1>
	<h2> CREATE USERS </h2>

	<div id='AddTasks'>
		<form action="/takeyourtime/addusers.php" method="post" enctype="multipart/form-data">
		<h4>Add User</h4>
		<p>	
		<label>User Name<br>
			<input type="text" required name="user-name" size="40" id="user-name"/>
		</label>
		</p>

	  	<input type="submit" value="Submit">
	</form>
	</div>

	</body>
</html>