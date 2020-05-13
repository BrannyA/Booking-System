<!DOCTYPE html>
<html>
<title>
    需求6：查询两地之间的返程车次
</title>
<head>
    <link rel="stylesheet" type="text/css" href="../style/search_form.css" />
</head>
<body>
    <h1 align="center">欢迎使用火车订票系统的需求6：查询两地之间的返程车次!</h1>
    <div class="container">
		<div class="box1">
            <form action="search_for_route.php" method="post">
            <br>
            <?php
                $from_station = $_GET["from_station"];
                $to_station = $_GET["to_station"];
                $date = $_GET["date"];
                function nextday($date){
                    return date("Y-m-d", strtotime($date ." +1 day"));
                }
                $nxtday=nextday($date);
                echo "出发地城市名:<br>";
                echo "<input type=\"text\" name=\"departureCity\" value=$from_station>";
                echo "<br>到达地城市名:<br>";
                echo "<input type=\"text\" name=\"arrivalCity\" value=$to_station>";
                echo "<br>出发日期:<br>";
                echo "<input type=\"date\" name=\"date\" value=$nxtday>";
            ?>
                <!--默认为5.1号为明天，可以改  -->
                <br>
                出发时间:<br>
                <input type="time" name="departureTime"value=00:00>
                <!--默认为00:00，可以改  -->
                <br>
                <input type="submit" value="Submit">
            </form>
            <br>
            <button type="button"><a  onclick="location.href='../home/index.php'"><h3>退出登录</h3></a></button>
            <br>
            <button type="button"><a  onclick="location.href='service.php'"><h3>返回服务页面</h3></a></button>
        </div>
	</div>
</body>
</html>
