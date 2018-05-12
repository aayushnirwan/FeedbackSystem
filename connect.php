<?php

	ob_start();
	session_start();
	$conn = new mysqli('localhost','root','','feedback');

	if($conn->connect_error)
		die("Sorry Can't Connect");

?>
