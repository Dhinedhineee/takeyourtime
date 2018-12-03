<html>
	<head>
		<title>
			Take Your Time
		</title>
		<link rel="stylesheet" type="text/css" href="styles/main.css">	
	</head>
	<body>

	<?php 
		require('logged.php'); 
	
		if (isset($_SESSION['reallyloggedin'])) {
			include('nav.php');
			echo '<div id="nav-placeholder"></div>
				<div class="startaction">
				<br>
				<h1> It\'s Time to Take Your Time </h1>
				
				<form action="./tasks">
					<input type="submit" value="ACHIEVE SOME TASKS">
				</form>
				</div>
			</div>';
		}
	?>
	</body>
</html>
