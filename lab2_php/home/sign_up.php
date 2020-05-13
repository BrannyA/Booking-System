<!DOCTYPE html>
<html>
<title>
	注册
</title>
<head>
    <link rel="stylesheet" type="text/css" href="../style/sign_up.css" />
</head>
<body>
	<h1 align="center">欢迎使用火车订票系统的注册界面!</h1>
	<div class="container">
		<div class="box1">
			<form action="deal_with_sign_up.php" method="post">
				姓名:<br>
				<input type="text" name="Realname" required="required" maxlength="10">
				<br>
				身份证号:<br>
				<input type="text" name="UID" required="required" maxlength="10">
				<br>
				用户名:<br>
				<input type="text" name="username" required="required" maxlength="10">
				<br>
				手机号:<br>
				<input type="text" name="Phone" required="required" maxlength="10">
				<br>
				信用卡:<br>
				<input type="text" name="creditsCard" required="required" maxlength="10">
				<br>
				<input type="submit" value="Submit">
			</form>
<!--
			<p>如果您点击提交，表单数据会被发送到名为deal_with_sign_up.php的页面。</p>

			<p>first name 不会被提交，因为此 input 元素没有 name 属性。</p> -->
			
			<a onclick="location.href='index.php'" class="text"><p>返回主页</p></a>
    </div>
</div>
</body>
</html>
