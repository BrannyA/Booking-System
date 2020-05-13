<!DOCTYPE html>
<html>
<title>
	火车订票系统
</title>
<head>
    <link rel="stylesheet" type="text/css" href="../style/general_small.css" />
</head>

<body>
	<h1 align="center">欢迎使用火车订票系统!</h1>
    <div class="container">
		<div class="box1">
			<?php	session_destroy(); ?>
			<br>
			<center>
			<div>
			   <a  onclick="location.href='sign_up.php'"><h2>注册</h2></a>
				<br>
				<a  onclick="location.href='sign_in.php'"><h2>登录</h2></a>
				<br>
				<a  onclick="location.href='../admin/administrator.php'"><h2>管理员模式</h2></a>
				<br>
			</div>
		</div>
	</div>
</body>
</html>
