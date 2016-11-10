<?php
    header("Content-Type:text/html; charset=utf-8");
	$con = mysqli_connect("localhost","root","","classroom");
	mysqli_query($con, "set names utf8;");
	date_default_timezone_set("PRC");//时区设置
	
//	mysql_connect("localhost","root","");
//	mysql_select_db("classroom");
//	mysql_query("set names utf8");
	
	//从表单中获得提交RFID卡号
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $rfid = $_POST["rfid"];
//		$room = $_POST["ROOM"];
    }
    //获取时间信息
    $time=date("Y-m-d H:i:s");
    $tt=$time;
    $time = substr($tt,11,2);
    $nowtime = substr($tt,11,8);
    $day = substr($tt,0,10);
    $whatday=date('w');
    $weeks=date('W');
	//判断时间
    if($time>=8&&$time<12) {
        $duration="morning";
    }
    if($time>=12&&$time<18) {
        $duration="afternoon";
    }
    if($time>=18&&$time<=22) {
        $duration="evening";
    }
	//根据读入的RFID卡号，将数据库中的姓名读取出来
	$result1 = mysqli_query($con, "SELECT name from student where rfid = '$rfid'");
	while($row = mysqli_fetch_array($result1)) {
		$name = $row['name'];
	}
	$checkined=false;
    $exist=false;
    // 签到将获取的学生信息数据存到checkin数据库中
    $result2 = mysqli_query($con, "SELECT * FROM checkin where id = '$name' and duration = '".$duration."'and date = '".$day."'");
    while($row = mysqli_fetch_array($result2)) {
        $start=$row['start'];
        $checkined=true;
    }
    if (!$checkined)
    {
		mysqli_query($con,"INSERT INTO checkin (id, start, duration, date) VALUES ('".$name."','".$nowtime."','".$duration."','".$day."')");
		 echo "<script>window.location='./result.php';</script>";
	}else {
	    $end=$nowtime;
	    $HH=substr($start,0,2);
	    $hh=substr($end,0,2);
	    $MM=substr($start,3,2);
	    $mm=substr($end,3,2);
	    $SS=substr($start,6,2);
	    $ss=substr($end,6,2);
	    $stay_time=$hh*60*60+$mm*60+$ss- ($HH*60*60+$MM*60+$SS);
	    //$HH=($stay_time/3600)%100;
	    //$MM=(($stay_time%3600)/60)%60;
	    $stay_time=($stay_time/60)%600;//=$HH."小时".$MM."分";
	    mysqli_query($con,"UPDATE checkin set end='".$nowtime."' ,stay_time='".$stay_time."' where id = '".$name."' and duration = '".$duration."'and date = '". $day."'");
		 echo "<script>alert('你好，你已签退成功！！！');window.location='./result.php';</script>";
	}
    // 将获取的时间数据存到数据库中
	$result3 = mysqli_query($con, "SELECT * FROM week_date where date = '".$day."'");
    while($row = mysqli_fetch_array($result3)) {
        $exist=true;
    }
    if(!$exist) {
        mysqli_query($con,"INSERT INTO week_date (date,whatday,weeks) VALUES ('".$day."','".$whatday."','".$weeks."')");
    }
    mysqli_close($con);
?> 