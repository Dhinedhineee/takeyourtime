<?php
	$conn=mysqli_connect("localhost","root","root","takeyourtime");
	
	if (!$conn)
	  	die("Connection error: " . mysqli_connect_error());
		
	
	$name = $_POST['ach-name'];
	$desc = htmlspecialchars($_POST['ach-desc'], ENT_QUOTES);
	$exp = (int)$_POST['ach-exp'];
	$query = "INSERT INTO Achievements (ach_name, description, exp_value) VALUES ('$name', '$desc', $exp);";
	var_dump($desc);
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
