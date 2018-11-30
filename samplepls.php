<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script src="script/jquery.js"/>
	<script>
		$(document).ready(function() {
			$("#butako").click(function() {
				$("#test").hide();
			});
		});	
	</script>
	<link rel="stylesheet" type="text/css" href="styles/main.css">	
</head>

<body>
	<p id="test">SAY SOMETHING</p>
	<button id="butako">click me</button>

</body>
</html>