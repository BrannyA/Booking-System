<!DOCTYPE html>
<html>
<title>
	注册
</title>

<body>
	<h1 align="center">欢迎使用火车订票系统的查询两地之间的车次!</h1>
	<!-- 这个是php操作，需求5的操作.暂时注释掉了
	<?php
	    $departureCity = $_POST["departureCity"];
	    $arrivalCity = $_POST["arrivalCity"];
	    $date = $_POST["date"];
	    $departureTime = $_POST["departureTime"];
		// Connecting, selecting database
		$dbconn = pg_connect("dbname=tpch user=dbms password=dbms")
	    or die('Could not connect: ' . pg_last_error());

		// Performing SQL query
		////////////////////////////////////需求5的查找操作，需要写
		//$query = 'SELECT * FROM nation';
		$result = pg_query($query) or die('Query failed: ' . pg_last_error());	
		// Closing connection
		pg_close($dbconn);
	?>
	  -->
	<br>
	<a  onclick="location.href='index.php'"><h2>返回主页</h2></a>

	<br>
	<a  onclick="location.href='service.php'"><h2>返回服务页</h2></a>
	<br>
	<a  onclick="location.href='service_5.php'"><h2>返回需求5查找页</h2></a>
</body>
</html>
