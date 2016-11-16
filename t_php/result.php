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
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">智慧教室管理系统</a>
            </div>
            <div class="navbar-collapse collapse navbar-responsive-collapse">
                <ul class="nav navbar-nav btn-group">
                    <li><a href="../t_html/rfid.html">学生账户登录</a></li>
                    <li><a href="./not_logout.php">当日考勤信息</a></li>
                    <li><a href="#">近期记录</a></li>
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
	<div class="container-fluid">
		<div class="col-md-10 col-md-offset-1">
			<table class='table table-bordered table-striped table-hover'>
				<thead>
					<tr>
						<th style='text-align: center;'>姓名</th>
						<th style='text-align: center;'>签到时间</th>
						<th style='text-align: center;'>签退时间</th>
						<th style='text-align: center;'>签到时长</th>
						<th style='text-align: center;'>时间段</th>
						<th style='text-align: center;'>日期</th>
					</tr>
				</thead>
				<tbody>
					<?php
						include 'head.php';
						$result = mysqli_query($con,"SELECT * FROM checkin order by date desc,start desc LIMIT 200");
						while($row = mysqli_fetch_array($result)) {
			 	        	echo "<tr>
			 	        		<td style='text-align: center;'><a href='name.php?name=".$row['name']."'>".$row['name']."</a></td>
			 	        		<td style='text-align: center;'>".$row['start']."</td>
			 	        		<td style='text-align: center;'>".$row['end']."</td>
			 	        		<td style='text-align: center;'>".(($row['stay_time']/60)%10)."小时".($row['stay_time']%60)."分钟</td>
			 	        		<td style='text-align: center;'>".$row['duration']."</td>
			 	        		<td style='text-align: center;'>".$row['date']."</td>
			 	        	</tr>";
			    		}
			    		mysqli_close($con);
					?>
				</tbody>
			</table>
		</div>
	</div>
</body>
</html>
