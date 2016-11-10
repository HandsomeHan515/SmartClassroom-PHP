<?php

	header("Content-Type:text/html; charset=utf-8");
	$connect = mysqli_connect("localhost","root","root","classroom");
	$room = "";
	$key = "";
	$state = "";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

		$room = $_POST["ROOM"];
		$key = $_POST["KEY"];
		$state = $_POST["STATE"];

    }
	// $room = "B9R420";
	switch ($key) {
		case 'S':
			# code...
		    $result = mysqli_query($connect,"UPDATE room SET light = '".$state."' WHERE rid = '".$room."'");
			if(mysqli_num_rows($result)){
				while($row = mysqli_fetch_array($result))
				{
					$state = $row['light'];
				}
				echo "$state";//向Qt返回信息		
			}
			break;

		case 'G':
			# code...
		    $result = mysqli_query($connect,"SELECT * FROM room WHERE rid = '".$room."'");
			if(mysqli_num_rows($result)){
				while($row = mysqli_fetch_array($result))
				{
					$state = $row['light'];
				}
				echo "$state";//向Qt返回信息		
			}
			break;
				
		default:
			# code...
			break;
	}
?>