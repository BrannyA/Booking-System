<!DOCTYPE html>
<html>
<title>
	注册
</title>

<body>
	<h1 align="center">欢迎使用火车订票系统的注册界面!</h1>
	<?php
	    $Realname = $_POST["Realname"];
	    $UID = $_POST["UID"];
	    $username = $_POST["username"];
	    $Phone = $_POST["Phone"];
	    $creditsCard = $_POST["creditsCard"];
		echo "Realname = $Realname <br>";
		echo "UID = $UID <br>";
		echo "username = $username <br>";
		echo "phone = $Phone <br>";
		echo "creditCard = $creditsCard <br>";
		// Connecting, selecting database

		$dbconn = pg_connect("dbname=tpch user=dbms password=dbms")
	    or die('Could not connect: ' . pg_last_error());

		$query = "
			insert into TrainUser
			values ('$username', '$Realname', '$UID','$Phone','$creditsCard');
		";
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
	<br>
	<a  onclick="location.href='../home/index.php'"><h2>返回首页</h2></a>
</body>
</html>
