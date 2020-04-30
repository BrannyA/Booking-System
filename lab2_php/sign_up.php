<!DOCTYPE html>
<html>
<title>
	注册
</title>

<body>
	<h1 align="center">欢迎使用火车订票系统的注册界面!</h1>
	<form action="deal_with_sign_up.php" method="post">
		姓名:<br>
		<input type="text" name="Realname">
		<br>
		身份证号:<br>
		<input type="text" name="UID">
		<br>
		用户名:<br>
		<input type="text" name="Username">
		<br>
		手机号:<br>
		<input type="text" name="Phone">
		<br>
		信用卡:<br>
		<input type="text" name="creditsCard">
		<br>
		<input type="submit" value="Submit">
	</form>

	<p>如果您点击提交，表单数据会被发送到名为deal_with_sign_up.php的页面。</p>

	<p>first name 不会被提交，因为此 input 元素没有 name 属性。</p>
	<br>
	<a  onclick="location.href='index.php'"><h2>返回主页</h2></a>
</body>
</html>
