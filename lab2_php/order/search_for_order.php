<!DOCTYPE html>
<html>
<title>
    查询订单和删除订单
</title>

<body>
    <h1 align="center">欢迎使用火车订票系统的查询订单和删除订单!</h1>
    <!-- 这个是php操作，需求8的查找操作中 ,暂时给注释掉了,需要填写，而且还要在打印出表后加上订票链接
    <?php
        $date_1 = $_POST["date_1"];
        $date_2 = $_POST["date_2"];
        session_start();
        $Username=$_SESSION["Username"];
    	// Connecting, selecting database
    	$dbconn = pg_connect("dbname=tpch user=dbms password=dbms")
        or die('Could not connect: ' . pg_last_error());

    	// Performing SQL query
    	////////////////////////////////////需求8的操作，需要写
    	//$query = 'SELECT * FROM nation';
    	$result = pg_query($query) or die('Query failed: ' . pg_last_error());
    	// Closing connection
        pg_close($dbconn);
        ////继续写操作
    ?>
      -->
    <!-- <br>
    <a  onclick="location.href='../home/index.php'"><h2>返回主页</h2></a> -->

    <br>
    <a  onclick="location.href='../search/service.php'"><h2>返回服务页</h2></a>
    <br>
    <a  onclick="location.href='service_8.php'"><h2>返回需求8查找页</h2></a>
</body>
</html>
