<?php
	header("Content-Type:text/html; charset=utf-8");
	$con = @mysqli_connect("localhost","root","","classroom");
	@mysqli_query($con,"set names utf8");
	if (!$con) {
		die('Could not connect: ' . @mysqli_error());
	}
	
	function test_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
?>