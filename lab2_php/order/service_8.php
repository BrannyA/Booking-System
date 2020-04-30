<!DOCTYPE html>
<html>
<title>
    需求8：查询订单和删除订单
</title>

<body>
    <h1 align="center">欢迎使用火车订票系统的需求8：查询订单和删除订单!</h1>
    <form action="search_for_order.php" method="post">
    <!--没想好送到哪里呢-->
        <br>
        出发日期范围_1:<br>
        <input type="date" name="date_1" value=2020-05-01>
        <!--默认为5.1号为明天，可以改  -->
        <br>
        出发日期范围_2:<br>
        <input type="date" name="date_2" value=2020-05-01>
        <!--默认为5.1号为明天，可以改  -->
        <br>
        <input type="submit" value="Submit">
    </form>

    <p>如果您点击提交，表单数据会被发送到名为search_for_order.php的页面。</p>

    <br>
    <a  onclick="location.href='index.php'"><h2>返回主页</h2></a>

    <br>
    <a  onclick="location.href='service.php'"><h2>返回服务页面</h2></a>
    <!-- ?????????? -->
</body>
</html>
