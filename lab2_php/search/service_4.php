<!DOCTYPE html>
<html>
<title>
    需求4：查询具体车次
</title>
<head>
    <link rel="stylesheet" type="text/css" href="../style/search_form.css" />
</head>
<body>
    <h1 align="center">欢迎使用火车订票系统的需求4：查询具体车次界面!</h1>
    <div class="container">
		<div class="box1">
            请填写要查询的车次<br>
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

            <br>
            <br>
            <button type="button"><a  onclick="location.href='../home/index.php'"><h3>退出登录</h3></a></button>
            <button type="button"><a  onclick="location.href='../search/service.php'"><h3>返回服务页面</h3></a></button>
        </div>
	</div>
</body>
</html>
