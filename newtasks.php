<?php
	$conn = new mysqli('localhost', 'root', '', 'takeyourtime');

	if ($conn->connect_error) die($conn->connect_error);


	$query = "SELECT * FROM projects WHERE proj_name = '$proj_name'";
	$result = $conn->query($query);

	$result->close();
	$conn->close();


	redirect('localhost/takeyourtime');
	function redirect($url){
		$string = '<script type="text/javascript">';
	    $string .= 'setTimeout(function(){window.location = "' . $url . '";}, 5);';
	    $string .= '</script>';
	    echo $string;
	    die();
	}
?>