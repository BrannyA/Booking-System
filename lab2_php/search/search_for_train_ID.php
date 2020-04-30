<!DOCTYPE html>
<html>
<title>
	注册
</title>

<body>
	<h1 align="center">欢迎使用火车订票系统的查询具体车次界面!</h1>
	<!-- 这个是php操作，需求4的查找操作中 ,暂时给注释掉了,需要填写，而且还要在打印出表后加上订票链接
	<?php
	    $ID = $_POST["ID"];
	    $date = $_POST["date"];
		// Connecting, selecting database
		$dbconn = pg_connect("dbname=tpch user=dbms password=dbms")
	    or die('Could not connect: ' . pg_last_error());

		// Performing SQL query
		////////////////////////////////////需求4的查找操作，需要写
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
	<a  onclick="location.href='service_4.php'"><h2>返回需求4查找页</h2></a>
</body>
</html>
