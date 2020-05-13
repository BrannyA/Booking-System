<!DOCTYPE html>
<html>
<title>
    需求8：查询订单和删除订单
</title>
<head>
    <link rel="stylesheet" type="text/css" href="../style/search_form.css" />
</head>
<body>
    <h1 align="center">欢迎使用火车订票系统的需求8：查询订单和删除订单!</h1>
    <div class="container">
		<div class="box1">
            <form action="search_for_order.php" method="post">
            <!--没想好送到哪里呢-->
                <br>查询出发日期在某两日之间的订单<br>
                从日期:<br>
                <input type="date" name="date_1" value=2020-05-01>
                <!--默认为5.1号为明天，可以改  -->
                <br>
                到日期:<br>
                <input type="date" name="date_2" value=2020-05-01>
                <!--默认为5.1号为明天，可以改  -->
                <br>
                <input type="submit" value="Submit">
            </form>

            <br>
            <button type="button"><a  onclick="location.href='../home/index.php'"><h3>退出登录</h3></a></button>
            <button type="button"><a  onclick="location.href='../search/service.php'"><h3>返回服务页面</h3></a></button>
            <!-- ?????????? -->
        </div>
	</div>
</body>
</html>
