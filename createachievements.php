
<html>
	<title>
		Take Your Time
	</title>

	<body>
	<h1> It's Time to Take Your Time </h1>
	<h2> CREATE ACHIEVEMENTS </h2>

	<div id='AddTasks'>
		<form action="./addachievements.php" method="post" enctype="multipart/form-data">
		<h4>Add Achievements</h4>
		<p><label>Achievement Name<br>
			<input type="text" required name="ach-name" size="40" id="ach-name"/>
		</label></p>

		<p><label>Achievement Desc<br>
			<textarea required name="ach-desc" rows="4" cols="50" id="ach-desc"></textarea>
		</label></p>

		<p><label>Achievement Exp<br>
			<input type="number" required name="ach-exp" size="40" id="ach-exp"/>
		</label></p>
		
	  	<input type="submit" value="Submit">
	</form>
	</div>

	</body>
</html>