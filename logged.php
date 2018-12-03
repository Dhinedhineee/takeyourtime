<?php
	session_start();
	if (!isset($_SESSION['reallyloggedin'])) {
		$string = '<script type="text/javascript">';
		$string .= 'setTimeout(function(){window.location = "login";}, 5);';
		$string .= '</script>';
		echo $string;
	}
?>
