<!DOCTYPE html>
<html>
<title>
	服务界面
</title>
<head>
    <link rel="stylesheet" type="text/css" href="../style/general_small.css" />
</head>
<body>
	<h1 align="center">欢迎使用火车订票系统的服务查询界面!</h1>
    <div class="container">
		<div class="box1">
			<?php
				session_start();
				$username = $_POST["Username"];
				if (!$username)
					$username = $_SESSION["Username"];
				else
					$_SESSION["Username"] = $username;
				// echo"hello";

				//查user表
				$dbconn = pg_connect("dbname=tpch user=dbms password=dbms")
				or die('Could not connect: ' . pg_last_error());
				$query_user = "
				select *
				from TrainUser
				where U_user_name='$username';
				";
				$result = pg_query($query_user) or die('Query failed: ' . pg_last_error());
				$result_user = pg_fetch_array($result, null, PGSQL_BOTH);

				if(!$result_user){
					echo "
						<h2><br>请先注册！</h2>
						<a  onclick=\"location.href='../home/index.php'\"><h2>返回主页</h2></a>
					";
				}
				else{
					// echo "<br>query result is $result_user<br>";
					echo "
						<div>
							<h2><br>请选择下列任意一项服务:</h2>
						</div>
						<br>
						<center>
						<div>
						<a  onclick=\"location.href='service_4.php'\"><h2>需求4：查询具体车次</h2></a>

							<a  onclick=\"location.href='service_5.php'\"><h2>需求5：查询两地之间的车次</h2></a>

							<a  onclick=\"location.href='../order/service_8.php'\"><h2>需求8：查询订单和删除订单</h2></a>
							<br>
						</div>
						<a  onclick=\"location.href='../home/index.php'\"><h2>退出登录</h2></a>
						";
				}
			?>
		</div>
	</div>


</body>
</html>
