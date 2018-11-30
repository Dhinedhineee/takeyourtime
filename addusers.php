<?php
	$conn=mysqli_connect("localhost","root","root","takeyourtime");
	
	if (!$conn)
	  	die("Connection error: " . mysqli_connect_error());
		
	
	$name = $_POST['user-name'];
	$query = "INSERT INTO User (user_name) VALUES ('$name');";
	var_dump($query);
	$result = $conn->query($query);
	var_dump($result);
	$conn->close();

	redirect('/takeyourtime');
	function redirect($url){
		$string = '<script type="text/javascript">';
	    $string .= 'setTimeout(function(){window.location = "' . $url . '";}, 5);';
	    $string .= '</script>';
	    echo $string;
	    die();
	}
?>
