<?php

	header("Content-Type:text/html; charset=utf-8");
	$connect = mysqli_connect("localhost","root","root","classroom");
	// $date = date("y-m-d");
	// $time = date("h:i:s");
	$room = "";
	$key = "";
	$name = "";
	$phone = "";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$room = $_POST["ROOM"];
		$key = $_POST["KEY"];
    }
    switch ($key) {
    	case 'student':
    		# code...
    		break;
    	
    	case 'teacher':
    		# code...
    		break;
    	
    	case 'absent':
    		# code...
    		break;
    	
    	default:
    		# code...
    		break;
    }
	$result = mysqli_query($connect,"SELECT * FROM student WHERE rfid = '".$rfid."'");
	if(mysqli_num_rows($result)){
		while($row = mysqli_fetch_array($result))
		{
			$name = $row['name'];
			$phone = $row['phone'];
		}
		echo "$name#$phone";//向Qt返回个人信息		
		mysqli_query($connect,"INSERT INTO checkin (checkin_id, rfid, name, room, date) VALUES ('$room 20$date $time','$rfid', '$name', '$room', '20$date')");//插入出勤信息
	}
	else
		echo "null#null";

?>