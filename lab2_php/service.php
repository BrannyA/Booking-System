<!DOCTYPE html>
<html>
<title>
	服务界面
</title>

<body>
	<h1 align="center">欢迎使用火车订票系统的服务查询界面!</h1>
	<?php
	//////////////这个用户名在管理员状态时用户名叫做administrator，利于在后面的服务写的时候分辨用
	////session的意思是把数据传到服务器上，可以在其他界面使用数据，应该是这个意思噗。
	    session_start();
	    $Username = $_POST["Username"];
	    if (!$Username)
	        $Username = $_SESSION["Username"];
	    else
	        $_SESSION["Username"] = $Username;
	    echo"hello";
	?>

	<h1 align="center">欢迎使用火车订票系统!</h1>
	<div>
		<h2><br>请选择下列任意一项服务:</h2>
	</div>
	<br>
	<center>
	<div>
		<a  onclick="location.href='service_4.php'"><h2>需求4：查询具体车次</h2></a>
		<br>
		<a  onclick="location.href='service_5.php'"><h2>需求5：查询两地之间的车次</h2></a>
		<br>
		<a  onclick="location.href='service_8.php'"><h2>需求8：查询订单和删除订单</h2></a>
		<br>
	</div>
	<a  onclick="location.href='index.php'"><h2>返回主页</h2></a>
</body>
</html>
