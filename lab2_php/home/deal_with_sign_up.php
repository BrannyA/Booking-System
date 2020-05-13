<!DOCTYPE html>
<html>
<title>
	注册
</title>
<head>
    <link rel="stylesheet" type="text/css" href="../style/deal_with_sign_up.css" />
</head>
<body>
	<h1 align="center">欢迎使用火车订票系统的注册界面!</h1>
	<div class="container">
		<div class="box1">
			<?php
				$Realname = $_POST["Realname"];
				$UID = $_POST["UID"];
				$username = $_POST["username"];
				$Phone = $_POST["Phone"];
				$creditsCard = $_POST["creditsCard"];
				echo "您的注册信息如下： <br>";
				echo "姓名 = $Realname <br>";
				echo "UID = $UID <br>";
				echo "用户名 = $username <br>";
				echo "手机号 = $Phone <br>";
				echo "信用卡 = $creditsCard <br>";
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
					echo"<br> 注册失败 <br>";
				}
				else
				{
					echo"<br> 注册成功！请记住您的用户名用于后续登录 <br>";
				}
				// Closing connection
				pg_close($dbconn);

			?>
			<br>
			<button type="button"><a  onclick="location.href='../home/index.php'"><h2>返回首页</h2></a></button>
		</div>
	</div>
</body>
</html>
