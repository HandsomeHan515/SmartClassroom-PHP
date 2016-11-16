<?php
	include 'head.php';
	date_default_timezone_set("PRC");//时区设置
	$time=date("Y-m-d H:i:s");
	$day = substr($time,0,10);
	$time = substr($time,11,2);
	if($time>=1&&$time<12) {
        $duration="morning";
    }
    if($time>=12&&$time<18) {
        $duration="afternoon";
    }
    if($time>=18&&$time<=24) {
        $duration="evening";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"> 
	<title>近期记录</title>
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<script src="../js/jquery-1.12.3.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>
</head>
<body>
	<!-- navbar -->
	<div class="navbar navbar-inverse index-nav">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse"
                        data-target=".navbar-responsive-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">智慧教室管理系统</a>
            </div>
            <div class="navbar-collapse collapse navbar-responsive-collapse">
                <ul class="nav navbar-nav btn-group">
                    <li><a href="../t_html/rfid.html">学生账户登录</a></li>
                    <li><a href="#">当日考勤信息</a></li>
                    <li><a href="./result.php">近期记录</a></li>
                    <li><a href="../t_html/week_result.html">周查询</a></li>
                    <li><a href="../t_html/month_result.html">具体时间查询</a></li>
                    <li><a href="../t_html/t_search.html">学生姓名查询</a></li>
                    <li><a href="times.php">签到统计</a></li>
                    <li><a href="../index.html">注销</a></li>
                </ul>
            </div>
        </div>
	</div>
	<!-- /navbar -->
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<?php
					echo "<h2>".$day." ".$duration."的出勤信息</h2>";
				?>
			</div>
		</div>
		<div class="col-md-5">
			<h2>班级学生信息汇总</h2>
			<table class='table table-bordered table-striped table-hover'>
				<thead>
					<tr>
						<th style='text-align: center;'>姓名</th>
						<th style='text-align: center;'>电话</th>
						<th style='text-align: center;'>邮箱</th>
						<th style='text-align: center;'>出勤次数</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$result = mysqli_query($con,"SELECT * FROM student where cid = '1'");
						while($row = mysqli_fetch_array($result)) {
							echo "<tr>
								<td style='text-align: center;'>".$row['name']."</td>
								<td style='text-align: center;'>".$row['phone']."</td>
								<td style='text-align: center;'>".$row['email']."</td>
								<td style='text-align: center;'>".$row['times']."</td>
							</tr>";
						}
					?>
				</tbody>
			</table>
		</div>
		<div class="col-md-4">
			<h2>已出勤学生信息</h2>
			<table class='table table-bordered table-striped table-hover'>
				<thead>
					<tr>
						<th style='text-align: center;'>姓名</th>
						<th style='text-align: center;'>签到时间</th>
						<th style='text-align: center;'>签退时间</th>
						<th style='text-align: center;'>时间段</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$result = mysqli_query($con, "select * from checkin where date = '$day'");	
						while($row = mysqli_fetch_array($result)) {
							echo "<tr>
								<td style='text-align: center;'>".$row['name']."</td>
								<td style='text-align: center;'>".$row['start']."</td>
								<td style='text-align: center;'>".$row['end']."</td>
								<td style='text-align: center;'>".$row['duration']."</td>
							</tr>";
						}
					?>
				</tbody>
			</table>
		</div>
		<div class="col-md-3">
			<h2>未出勤的学生</h2>
			<table class='table table-bordered table-striped table-hover'>
				<thead>
					<tr>
						<th style='text-align: center;'>姓名</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$result = mysqli_query($con,"SELECT name FROM student WHERE NOT EXISTS(SELECT name FROM checkin WHERE checkin.name = student.name and date='$day' and duration = '$duration')");
						while ($row = mysqli_fetch_array($result)) {
							echo "<tr>
								<td style='text-align: center;'>".$row['name']."</td>
							</tr>";
						}
						mysqli_close($con);
					?>
				</tbody>
		</div>
	</div>
</body>
</html>
