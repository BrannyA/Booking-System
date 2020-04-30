<!DOCTYPE html>
<html>
<title>
	登录
</title>

<head>
    <link rel="stylesheet" type="text/css" href="../style/sign_in.css" />
</head>

<body>
	<h1 align="center">欢迎使用火车订票系统的登录界面!</h1>
	<div class="login_box">
		<form action="../search/service.php" method="post">
			<p class="login_title">用户名<p>
			<input type="text" placeholder="username" name="Username">
			<br>
			<input type="submit" value="Submit">
		</form>
		<a onclick="location.href='index.php'" class="text"><p>返回主页</p></a>
	</div>
	<!-- <font color="white">如果您点击提交，表单数据会被发送到名为service.php的页面。</font> -->

</body>
</html>
