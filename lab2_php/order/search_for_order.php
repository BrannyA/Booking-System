<!DOCTYPE html>
<html>
<title>
    查询订单和删除订单
</title>
<head>
    <link rel="stylesheet" type="text/css" href="../style/search_for_order.css" />
</head>
<body>
    <h1 align="center">欢迎使用火车订票系统的查询订单和删除订单!</h1>
    <div class="container">
		<div class="box1">
            <?php
                $date_1 = $_POST["date_1"];
                $date_2 = $_POST["date_2"];
                session_start();
                $username=$_SESSION["Username"];
                echo "<br>username = $username";
                echo "<br>date_1 = $date_1";
                echo "<br>date2 = $date_2<br>";
                // echo "<td><a href=\"cancel_order.php?R_ID=ridExample&train_id=idEx&d_station=dstaEx&a_station=astaEx&date=dateEx&type=typeEx\">取消订单</a></td>";

                // Connecting, selecting database
                $dbconn = pg_connect("dbname=tpch user=dbms password=dbms")
                or die('Could not connect: ' . pg_last_error());
                $search_order = "
                    select *
                    from Reservation
                    where R_username='$username'
                    and R_start_date>='$date_1'::date
                    and R_start_date<='$date_2'::date
                    order by R_start_date,R_ID;
                ";
                $result_order = pg_query($search_order) or die('Query failed: ' . pg_last_error());
                // Closing connection
                if (!$result_order){
                    echo"<br><p>没有查到符合要求的订单</p>";
                }
                else{
                    echo "$username, $date_1 到$date_2 间，您的订单信息如下:<br>";
                    echo "<table>\n";
                    echo "<tr>";
                    echo "<td>订单号</td>" ;
                    echo "<td>车号</td>";
                    echo "<td>到达站</td>" ;
                    echo "<td>起始站</td>" ;
                    echo "<td>开车日期</td>" ;
                    echo "<td>下单日期</td>";
                    echo "<td>座位类型</td>" ;
                    echo "<td>价格</td>" ;
                    echo "<td>订单状态</td>" ;
                    echo "</tr>";
                    while ($line = pg_fetch_array($result_order, null, PGSQL_BOTH)) {
                        echo "\t<tr>\n";
                        echo "<td>$line[0]</td>";
                        echo "<td>$line[7]</td>";
                        echo "<td>$line[5]</td>";
                        echo "<td>$line[6]</td>";
                        echo "<td>$line[2]</td>";
                        echo "<td>$line[3]</td>";
                        echo "<td>$line[8]</td>";
                        echo "<td>$line[9]</td>";
                        echo "<td>$line[1]</td>";
                        echo "<td><a href=\"../order/cancel_order.php?R_ID=$line[0]&train_id=$line[7]&d_station=$line[5]&a_station=$line[6]&date=$line[2]&type=$line[8]\">取消订单</a></td>";
                        echo "\t</tr>\n";
                    }
                    echo "</table>\n";
                    echo "<br>";

                }
                pg_close($dbconn);
                ////继续写操作

            ?>

            <br>
            <button type="button"><a  onclick="location.href='../home/index.php'"><h2>退出登录</h2></a></button>

            <br>
            <button type="button"><a  onclick="location.href='../search/service.php'"><h2>返回服务页</h2></a></button>
            <br>
            <button type="button"><a  onclick="location.href='service_8.php'"><h2>返回需求8查找页</h2></a></button>
        </div>
	</div>
</body>
</html>
