<html>
<head>
	<title></title>
</head>
<body>
	<header>
		<nav>
			<li><a href='.'>TAKE YOUR TIME</a></li>
			<li><a href='./createtasks'>ADD NEW TASKS</a></li>
			<li><a href='./createlabels'>ADD NEW LABELS</a></li>
			<li><a href='./tags'>TAG SOME TASKS</a></li>
			<li><a href='./breakdown'>BREAK SOME TASKS</a></li>
			<li><a href='./usertimer'>TASK TIMERS</a></li>
			<div class='user'>
				<li><?php 
				echo "<a href=#>Hello, ".$_SESSION['username']?>!</a></li>
				<li><a href='./logout'>Sign Out</a></li>
			</div>
		</nav>		
	</header>
</body>
</html>