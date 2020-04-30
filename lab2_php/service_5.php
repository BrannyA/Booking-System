<!DOCTYPE html>
<html>
<title>
需求5：查询两地之间的车次
</title>
<body>

<h1 align="center">欢迎使用火车订票系统的需求5：查询两地之间的车次!</h1>
<form action="search_for_route.php" method="post">
<!--没想好送到哪里呢-->
<br>
出发地城市名:<br>
<input type="text" name="departureCity">
<br>
到达地城市名:<br>
<input type="text" name="arrivalCity">
<br>
出发日期:<br>
<input type="date" name="date" value=2020-05-01>
<!--默认为5.1号为明天，可以改  -->
<br>
出发时间:<br>
<input type="time" name="departureTime"value=00:00>
<!--默认为00:00，可以改  -->
<br>
<input type="submit" value="Submit">
</form> 

<p>如果您点击提交，表单数据会被发送到名为search_for_route.php的页面。</p>

<br>
<a  onclick="location.href='index.php'"><h2>返回主页</h2></a>

<br>
<a  onclick="location.href='service.php'"><h2>返回服务页面</h2></a>
</body>
</html>