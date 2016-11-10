<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"> 
	<title>学生课程表</title>
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
                    <li><a href="./../s_html/s_search.html">学生个人信息查询</a></li>
                    <li><a href="#">近期记录</a></li>
                    <li><a href="./../s_html/attendance.html">学生课表查询</a></li>
                    <li><a href="../index.html">注销</a></li>
                </ul>
            </div>
        </div>
	</div>
	<!-- /navbar -->
	<?php
		header("Content-Type:text/html; charset=utf-8");
		$con = mysqli_connect("localhost","root","","classroom");
		mysqli_query($con, "set names utf8;");
		if (!$con) {
			die('Could not connect: ' . mysqli_error());
		}
		$name = $_POST['name'];
		$result = mysqli_query($con, "select * from class where name='$name'");
		while($row = mysqli_fetch_array($result)) {
			$class_one = $row['class_one'];
			$class_two = $row['class_two'];
			$class_three = $row['class_three'];
			$class_four = $row['class_four'];
			$class_five = $row['class_five'];
			$class_six = $row['class_six'];
		}
		echo "<div class='container'>
			<div class='row'>
				<div class='col-md-2'></div>
				<div class='col-md-8'>
				<h3>".$name."的课表</h3>
					<table class='table table-striped table-bordered table-hover table-condensed'>
						<thead>
							<tr>
								<th style='text-align: center;'>课程/时间</th>
								<th style='text-align: center;'>星期一</th>
								<th style='text-align: center;'>星期二</th>
								<th style='text-align: center;'>星期三</th>
								<th style='text-align: center;'>星期四</th>
								<th style='text-align: center;'>星期五</th>
								<th style='text-align: center;'>星期六</th>
								<th style='text-align: center;'>星期日</th>
							</tr>
							<tr><td></td></tr>
							<tr>
								<td style='text-align: center;'>一二节课</td>
								<td style='text-align: center;'>$class_one</td>
								<td style='text-align: center;'>$class_two</td>
								<td style='text-align: center;'>$class_three</td>
								<td style='text-align: center;'>$class_four</td>
								<td style='text-align: center;'>$class_five</td>
								<td style='text-align: center;'>$class_six</td>
								<td style='text-align: center;'></td>	
							</tr>
							<tr><td></td></tr>
							<tr>
								<td style='text-align: center;'>三四节课</td>
								<td style='text-align: center;'>$class_two</td>
								<td style='text-align: center;'>$class_three</td>
								<td style='text-align: center;'>$class_four</td>
								<td style='text-align: center;'>$class_five</td>
								<td style='text-align: center;'>$class_six</td>
								<td style='text-align: center;'>$class_one</td>
								<td style='text-align: center;'></td>	
							</tr>
							<tr><td></td></tr>
							<tr>
								<td style='text-align: center;'>五六节课</td>
								<td style='text-align: center;'>$class_one</td>
								<td style='text-align: center;'>$class_two</td>
								<td style='text-align: center;'>$class_three</td>
								<td style='text-align: center;'>$class_four</td>
								<td style='text-align: center;'>$class_five</td>
								<td style='text-align: center;'>$class_six</td>
								<td style='text-align: center;'></td>		
							</tr>
							<tr><td></td></tr>
							<tr>
								<td style='text-align: center;'>七八节课</td>
								<td style='text-align: center;'>$class_two</td>
								<td style='text-align: center;'>$class_three</td>
								<td style='text-align: center;'>$class_four</td>
								<td style='text-align: center;'>$class_five</td>
								<td style='text-align: center;'>$class_six</td>
								<td style='text-align: center;'>$class_one</td>
								<td style='text-align: center;'></td>
							</tr>
							<tr><td></td></tr>
							<tr>
								<td style='text-align: center;'>九十节课</td>
								<td style='text-align: center;'></td>
								<td style='text-align: center;'></td>
								<td style='text-align: center;'></td>
								<td style='text-align: center;'></td>
								<td style='text-align: center;'></td>
								<td style='text-align: center;'></td>
								<td style='text-align: center;'></td>	
							</tr>
						</thead>
						<tbody>
						
						</tbody>
					</table>
				</div>
				<div class='col-md-2'></div>
			</div>
		</div>";
	?>
</body>
</html>
	