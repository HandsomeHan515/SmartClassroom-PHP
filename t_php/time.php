<?php
	header("Content-Type:text/html; charset=utf-8");
	$con = mysqli_connect("localhost","root","","classroom");
	mysqli_query($con, "set names utf8;");
	$time=date("Y-m-d H:i:s");
	$day = substr($time,0,10);
	$time = substr($time,11,2);
	if($time>=8&&$time<12) {
        $duration="morning";
    }
    if($time>=12&&$time<18) {
        $duration="afternoon";
    }
    if($time>=18&&$time<=22) {
        $duration="evening";
    }
	$result = mysqli_query($con, "SELECT * FROM time where class='class_one'");
	while($row = mysqli_fetch_array($result)) {
		$duration = $row['duration'];
		echo $duration;
	}
	$result = mysqli_query($con, "SELECT * FROM class WHERE cid='1'");
	while($row = mysqli_fetch_array($result)) {
		$class= $row['class_one'];
		echo $class;
	}
	$result = mysqli_query($con,"SELECT name FROM student WHERE NOT EXISTS(SELECT id FROM checkin WHERE checkin.id = student.name and date='$day' and duration = '$duration')");
	while($row = mysqli_fetch_array($result)) {
		$name = $row['name'];
		echo $name;
	}
	$result = mysqli_query($con, "SELECT * FROM room WHERE rid = '1'");
	while($row = mysqli_fetch_array($result)) {
		$position = $row['position'];
		$features = $row['features'];
		echo $position;
		echo $features;
	}
?>