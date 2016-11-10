<?php
	header("Content-Type:text/html; charset=utf-8");
	$con = mysqli_connect("localhost","root","","classroom");
	mysqli_query($con,"set names utf8");
	date_default_timezone_set("PRC");//时区设置
	if (!$con) {
		die('Could not connect: ' . mysqli_error());
	}
	//获取时间信息
    $time = date("Y-m-d H:i:s");
    $tt = $time;
    $time = substr($tt,11,2);
    $nowtime = substr($tt,11,8);
    $day = substr($tt,0,10);
    $whatday = date('w');
    $weeks = date('W');
	//判断时间
    if($time >= 8 && $time < 12) {
        $duration = "morning";
    }
    if($time >= 12 && $time < 18) {
        $duration = "afternoon";
    }
    if($time >= 18 && $time <= 22) {
        $duration = "evening";
    }
	//获取 从表单输入的RFID号和本机IP
    $rfid = $_POST["rfid"];
    $ip = $_SERVER["REMOTE_ADDR"];
	//根据RFID号从数据库中获取相应的学生姓名
	$result = mysqli_query($con, "select name from student where rfid = '$rfid'");
	while($row = mysqli_fetch_array($result)) {
		$name = $row['name'];
		echo $name."<br>";
	}
	//根据RFID判断结束
	//判断时间是否存在若不存在则将当前时间插入到数据库当中去
	$exist = false;
	$date = mysqli_query($con, "select * from week_date where date = '$day'");
	while($row = mysqli_fetch_array($date)) {
		echo $row['date']."<br>";
		echo $row['whatday']."<br>";
		echo $row['weeks']."<br>";
		$exist = true;
	}
	if(!$exist) {
		mysqli_query($con, "insert into week_date (date,whatday,weeks) values ('$day','$whatday','$weeks')");
	}
	//判断时间结束
	//将新数据插入到checkin数据库中
	$checkin = false;
	$message = mysqli_query($con, "select * from checkin where (id = '$name' and duration = '$duration' and date = '$day')");
	while($row = mysqli_fetch_array($message)) {
		echo $row['start']."<br>";
		echo $row['duration']."<br>";
		echo $row['date']."<br>";
		$checkin = true;
	}
	if(!$checkin) {
		mysqli_query($con, "insert into checkin (id,start,duration,ip,date) values ('$name','$nowtime','$duration','$ip','$day')");
	}
	
?>