<!DOCTYPE html>
<html>
<title>
    需求4：查询具体车次
</title>
<body>
    <h1 align="center">欢迎使用火车订票系统的需求4：查询具体车次界面!</h1>
    <form action="search_for_train_ID.php" method="post">
    <!--没想好送到哪里呢-->
        <br>
        车次:<br>
        <input type="text" name="ID">
        <br>
        日期:<br>
        <input type="date" name="date" value=2020-05-01>
        <!--默认为5.1号为明天，可以改  -->
        <br>
        <input type="submit" value="Submit">
    </form>

    <p>如果您点击提交，表单数据会被发送到名为search_for_train_ID.php的页面。</p>

    <br>
    <a  onclick="location.href='../home/index.php'"><h2>退出登录</h2></a>
    <br>
    <a  onclick="location.href='service.php'"><h2>返回服务业</h2></a>
</body>
</html>
