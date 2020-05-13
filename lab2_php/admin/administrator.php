<!DOCTYPE html>
<html>
<title>
	管理员
</title>
<head>
    <link rel="stylesheet" type="text/css" href="../style/general_small.css" />
</head>

<body>
	<h1 align="center">欢迎管理员!</h1>
    <div class="container">
		<div class="box1">
			<?php

				// Connecting, selecting database
				$dbconn = pg_connect("dbname=tpch user=dbms password=dbms") or die('Could not connect: ' . pg_last_error());
				$count_order = "
					select count(*) as Number
					from Reservation
					where R_status='已确认订单';
				";
				$total_price = "
					select sum(R_price) as total_price
					from Reservation
					where R_status='已确认订单';
				";
				$hot_train = "
					select R_TrainID, count(*) as Number
					from Reservation
					where R_status='已确认订单'
					group by R_TrainID
					order by Number;
				";
				$users = "
					select * from TrainUser;
				";
				$result_o = pg_query($count_order) or die('Query failed: ' . pg_last_error());
				$order_num = pg_fetch_array($result_o, null, PGSQL_BOTH);
				echo "<br>总订单数: $order_num[0]";
				$price = pg_query($total_price) or die('Query failed: ' . pg_last_error());
				$p = pg_fetch_array($price, null, PGSQL_BOTH);
				echo "<br>订单总价: $p[0] 元 <br>";
				$hot = pg_query($hot_train) or die('Query failed: ' . pg_last_error());
				if (!$hot){
					echo"<br><p>暂无热门车次</p>";
				}
				else{
					echo "<br>热门车次如下：<br>";
					echo "<table>\n";
					echo "<tr>";
					echo "<td>车号</td>" ;
					echo "<td>订单数</td>";
					echo "</tr>";
					while ($line = pg_fetch_array($hot, null, PGSQL_BOTH)) {
						echo "\t<tr>\n";
						for ($i = 0; $i < 9; $i++) {
							echo "<td>$line[$i]</td>";
						}
						echo "\t</tr>\n";
					}
					echo "</table>\n";
					echo "<br>";
				}


				$result_user = pg_query($users) or die('Query failed: ' . pg_last_error());
				if (!$result_user){
					echo"<br><p>暂无用户</p>";
				}
				else{
					echo "<br>用户列表如下，点击用户名以查看详细信息<br>";
					echo "<table>\n";
					echo "<tr>";
					echo "<td>用户名</td>" ;
					echo "<td>用户id</td>";
					echo "<td>姓名</td>";
					echo "<td>手机号</td>";
					echo "<td>信用卡</td>";
					echo "</tr>";
					while ($line = pg_fetch_array($result_user, null, PGSQL_BOTH)) {
						echo "\t<tr>\n";
						echo "<td><a href=\"admin_user.php?&username=$line[0]\">$line[0]</a></td>";
						for ($i = 1; $i < 5; $i++) {
							echo "<td>$line[$i]</td>";
						}
						echo "\t</tr>\n";
					}
					echo "</table>\n";
					echo "<br>";

				}


				// Closing connection

				pg_close($dbconn);
				////继续写操作

			?>

			<br>
			<button type="button"><a  onclick="location.href='../home/index.php'"><h2>退出管理员模式</h2></a></button>
		</div>
	</div>
</body>
</html>
