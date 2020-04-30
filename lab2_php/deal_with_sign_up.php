<!DOCTYPE html>
<html>
<title>
	注册
</title>
<body>

<h1 align="center">欢迎使用火车订票系统的注册界面!</h1>
<!-- 这个是php操作，目的是将传过来的数据处理并插入table中 
<?php 
    $Realname = $_POST["Realname"];
    $UID = $_POST["UID"];
    $Username = $_POST["Username"];
    $Phone = $_POST["Phone"];
    $creditsCard = $_POST["creditsCard"];
	// Connecting, selecting database
	$dbconn = pg_connect("dbname=tpch user=dbms password=dbms")
    or die('Could not connect: ' . pg_last_error());

	// Performing SQL query
	////////////////////////////////////插入table操作
	//insert
	//$query = 'SELECT * FROM nation';
	$result = pg_query($query) or die('Query failed: ' . pg_last_error());
	if (!$result)
	{
		echo"<br>wrong!!!!!!!!!!!!!重新注册！！！！！！！！<br>";
	}
	else
	{
		echo"<br>success!!!!!!!!!!!<br>";
	}	
	// Closing connection
	pg_close($dbconn);
?>
  -->
<br>
<a  onclick="location.href='index.php'"><h2>返回</h2></a>
</body>
</html>