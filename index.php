<?php ?>

<html>
	<head>
		<title>
			Take Your Time
		</title>
		<link rel="stylesheet" type="text/css" href="styles/main.css">	
		<script src="script/jquery-1.10.2.js"></script>
	</head>
	<body>

	<?php 
		require('logged.php'); 
		if (isset($_SESSION['reallyloggedin'])) {
		echo '<div id="nav-placeholder"></div>
				<div class="startaction">
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


<script>
	$(function(){
	  $("#nav-placeholder").load("nav.html");
	});
</script>