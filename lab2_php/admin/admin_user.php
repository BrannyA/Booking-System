<!DOCTYPE html>
<html>
<title>
	管理员-用户信息
</title>

<body>
	<h1 align="center">欢迎管理员!</h1>
	<h3 align="center">查看用户信息</h3>
    <?php
        $username = $_GET["username"];
		echo "<br>username = $username";
    	// Connecting, selecting database
    	$dbconn = pg_connect("dbname=tpch user=dbms password=dbms") or die('Could not connect: ' . pg_last_error());
		$user_order = "
			select *
			from Reservation
			where R_username='$username';
		";
    	$result = pg_query($user_order) or die('Query failed: ' . pg_last_error());
        if (!$result){
			echo"<br><p>该用户没有订单</p>";
		}
		else{
            echo "<br>用户 $username 的订单信息如下:<br>";
            echo "<table>\n";
            echo "<tr>";
            echo "<td>订单号</td>" ;
            echo "<td>车号</td>";
            echo "<td>起始站</td>" ;
            echo "<td>到达站</td>" ;
            echo "<td>开车日期</td>" ;
            echo "<td>下单日期</td>";
            echo "<td>座位类型</td>" ;
            echo "<td>价格</td>" ;
            echo "<td>订单状态</td>" ;
            echo "</tr>";
            while ($line = pg_fetch_array($result, null, PGSQL_BOTH)) {
                echo "\t<tr>\n";
                for ($i = 0; $i < 9; $i++) {
                    echo "<td>$line[$i]</td>";
                }
                echo "\t</tr>\n";
            }
            echo "</table>\n";
            echo "<br>";

		}
        pg_close($dbconn);
        ////继续写操作

    ?>
	<br>
	<a  onclick="location.href='administrator.php'"><h2>返回管理员主页</h2></a>
	<br>
	<a  onclick="location.href='../home/index.php'"><h2>退出管理员模式</h2></a>
</body>
</html>
