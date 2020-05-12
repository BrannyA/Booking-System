<!DOCTYPE html>
<html>
<title>
	选择座位-换乘车票
</title>

<body>
	<h1 align="center">选择座位</h1>
	<?php
        session_start();
        $username = $_SESSION["Username"];
        // $userid = $_SESSION["userid"];
		$date = $_GET["date"];
		$date2 = $_GET["date2"];
		$line0 = $_GET["line_0"];
		$line1 = $_GET["line_1"];
		$line2 = $_GET["line_2"];
		$line3 = $_GET["line_3"];
		$line4 = $_GET["line_4"];
		$line5 = $_GET["line_5"];
		$line6 = $_GET["line_6"];
		$line7 = $_GET["line_7"];
		$line8 = $_GET["line_8"];
		$line9 = $_GET["line_9"];
		$line10 = $_GET["line_10"];
		$line11 = $_GET["line_11"];
		$line12 = $_GET["line_12"];
		$line13 = $_GET["line_13"];
		$line14 = $_GET["line_14"];
		$line15 = $_GET["line_15"];
		$line16 = $_GET["line_16"];
		$line17 = $_GET["line_17"];
		$line18 = $_GET["line_18"];
        $line19 = $_GET["line_19"];
		$line20 = $_GET["line_20"];
		$line21 = $_GET["line_21"];
		$line22 = $_GET["line_22"];
		$line23 = $_GET["line_23"];
		$line24 = $_GET["line_24"];
		$line25 = $_GET["line_25"];
		$line26 = $_GET["line_26"];
		$line27 = $_GET["line_27"];
		$line28 = $_GET["line_28"];
		$line29 = $_GET["line_29"];
		$line30 = $_GET["line_30"];
		$line31 = $_GET["line_31"];
		$line32 = $_GET["line_32"];
		$line33 = $_GET["line_33"];
		$line34 = $_GET["line_34"];
		$line35 = $_GET["line_35"];
		$line36 = $_GET["line_36"];
		$line37 = $_GET["line_37"];
		$line38 = $_GET["line_38"];
		$line39 = $_GET["line_39"];
		$line40 = $_GET["line_40"];
		$line41 = $_GET["line_41"];
		$line42 = $_GET["line_42"];
		$line43 = $_GET["line_43"];
		$info = array($line0,$line1,$line2,$line3,$line4,$line5,$line6,$line7,$line8,$line9,$line10,
						$line11,$line12,$line13,$line14,$line15,$line16,$line17,$line18,$line19,$line20,
						$line21,$line22,$line23,$line24,$line25,$line26,$line27,$line28,$line29,$line30,
						$line31,$line32,$line33,$line34,$line35,$line36,$line37,$line38,$line39,$line40,
						$line41,$line42,$line43);
		echo "<br>username = $username";
        // echo "<br>info = $info <br>";
		echo "您的出发日期为 $date";
        echo "您选择的车次为$line0 换乘$line19 ，总用时$line42 ，价格$line43 起：<br>";
        echo "以下座位信息为[余票|票价]<br>";
		echo "<table>\n";
		echo "<tr>";
		echo "<td>车号</td>" ;
		echo "<td>起始站</td>" ;
		echo "<td>到达站</td>" ;
		echo "<td>出发时间</td>";
		echo "<td>到达时间</td>" ; //4
        echo "<td>硬座</td>" ;
        echo "<td>软座</td>" ;
        echo "<td>硬卧上</td>";
        echo "<td>硬卧中</td>" ;
        echo "<td>硬卧下</td>" ;
        echo "<td>软卧上</td>" ;
        echo "<td>软卧下</td>";
		echo "</tr>";
		for ($a = 0; $a < 2; $a++) {
			echo "\t<tr>\n";
			for ($i = 0; $i < 5; $i++) {
				$temp = 19 * $a + $i;
				echo "<td>$info[$temp]</td>";
			}
			for ($i = 5; $i < 12; $i++){
				$temp = 19 * $a + $i;
				if(!$info[$temp])
					echo "<td>无票</td>";
				else{
				    $temp2 = $temp + 7;
					echo "<td>$info[$temp]|$info[$temp2]</td>";
				}
			}
			echo "\t</tr>\n";
        }
		echo "</table>\n";
		echo "<br>";


        echo "<br>选择两个车次的座位<br>";
        echo "<form action=\"booking_two.php\" method=\"POST\">";
        echo "<p hidden>";
		echo "<input type=\"checkbox\" checked name=\"line_0\" value=\"$line0\"> <br>";
		echo "<input type=\"checkbox\" checked name=\"line_0\" value=\"$line0\"> <br>";
		echo "<input type=\"checkbox\" checked name=\"line_1\" value=\"$line1\"> <br>";
		echo "<input type=\"checkbox\" checked name=\"line_2\" value=\"$line2\"> <br>";
		echo "<input type=\"checkbox\" checked name=\"line_3\" value=\"$line3\"> <br>";
		echo "<input type=\"checkbox\" checked name=\"line_4\" value=\"$line4\"> <br>";
		echo "<input type=\"checkbox\" checked name=\"line_5\" value=\"$line5\"> <br>";
		echo "<input type=\"checkbox\" checked name=\"line_6\" value=\"$line6\"> <br>";
		echo "<input type=\"checkbox\" checked name=\"line_7\" value=\"$line7\"> <br>";
		echo "<input type=\"checkbox\" checked name=\"line_8\" value=\"$line8\"> <br>";
		echo "<input type=\"checkbox\" checked name=\"line_9\" value=\"$line9\"> <br>";
		echo "<input type=\"checkbox\" checked name=\"line_10\" value=\"$line10\"> <br>";
		echo "<input type=\"checkbox\" checked name=\"line_11\" value=\"$line11\"> <br>";
		echo "<input type=\"checkbox\" checked name=\"line_12\" value=\"$line12\"> <br>";
		echo "<input type=\"checkbox\" checked name=\"line_13\" value=\"$line13\"> <br>";
		echo "<input type=\"checkbox\" checked name=\"line_14\" value=\"$line14\"> <br>";
		echo "<input type=\"checkbox\" checked name=\"line_15\" value=\"$line15\"> <br>";
		echo "<input type=\"checkbox\" checked name=\"line_16\" value=\"$line16\"> <br>";
		echo "<input type=\"checkbox\" checked name=\"line_17\" value=\"$line17\"> <br>";
		echo "<input type=\"checkbox\" checked name=\"line_18\" value=\"$line18\"> <br>";
		echo "<input type=\"checkbox\" checked name=\"line_19\" value=\"$line19\"> <br>";
		echo "<input type=\"checkbox\" checked name=\"line_20\" value=\"$line20\"> <br>";
		echo "<input type=\"checkbox\" checked name=\"line_21\" value=\"$line21\"> <br>";
		echo "<input type=\"checkbox\" checked name=\"line_22\" value=\"$line22\"> <br>";
		echo "<input type=\"checkbox\" checked name=\"line_23\" value=\"$line23\"> <br>";
		echo "<input type=\"checkbox\" checked name=\"line_24\" value=\"$line24\"> <br>";
		echo "<input type=\"checkbox\" checked name=\"line_25\" value=\"$line25\"> <br>";
		echo "<input type=\"checkbox\" checked name=\"line_26\" value=\"$line26\"> <br>";
		echo "<input type=\"checkbox\" checked name=\"line_27\" value=\"$line27\"> <br>";
		echo "<input type=\"checkbox\" checked name=\"line_28\" value=\"$line28\"> <br>";
		echo "<input type=\"checkbox\" checked name=\"line_29\" value=\"$line29\"> <br>";
		echo "<input type=\"checkbox\" checked name=\"line_30\" value=\"$line30\"> <br>";
		echo "<input type=\"checkbox\" checked name=\"line_31\" value=\"$line31\"> <br>";
		echo "<input type=\"checkbox\" checked name=\"line_32\" value=\"$line32\"> <br>";
		echo "<input type=\"checkbox\" checked name=\"line_33\" value=\"$line33\"> <br>";
		echo "<input type=\"checkbox\" checked name=\"line_34\" value=\"$line34\"> <br>";
		echo "<input type=\"checkbox\" checked name=\"line_35\" value=\"$line35\"> <br>";
		echo "<input type=\"checkbox\" checked name=\"line_36\" value=\"$line36\"> <br>";
		echo "<input type=\"checkbox\" checked name=\"line_37\" value=\"$line37\"> <br>";
		echo "<input type=\"checkbox\" checked name=\"line_38\" value=\"$line38\"> <br>";
		echo "<input type=\"checkbox\" checked name=\"line_39\" value=\"$line39\"> <br>";
		echo "<input type=\"checkbox\" checked name=\"line_40\" value=\"$line40\"> <br>";
		echo "<input type=\"checkbox\" checked name=\"line_41\" value=\"$line41\"> <br>";
		echo "<input type=\"checkbox\" checked name=\"line_42\" value=\"$line42\"> <br>";
		echo "<input type=\"checkbox\" checked name=\"line_43\" value=\"$line43\"> <br>";
		echo "
			<input type=\"checkbox\" checked name=\"date\" value=\"$date\"> $date<br>
            <input type=\"checkbox\" checked name=\"date2\" value=\"$date2\"> $date2<br>
            </p>
            ";
        echo "<p>$info[0]</p>";
        echo "<select name=\"Seat1\">";
            if($info[5])
                  echo "<option value=\"硬座\">硬座</option>";
            if($info[6])
                echo "<option value=\"软座\">软座</option>";
            if($info[7])
                echo "<option value=\"硬卧上铺\">硬卧上铺</option>";
            if($info[8])
                echo "<option value=\"硬卧中铺\">硬卧中铺</option>";
            if($info[9])
                echo "<option value=\"硬卧下铺\">硬卧下铺</option>";
            if($info[10])
                echo "<option value=\"软卧上铺\">软卧上铺</option>";
            if($info[11])
                echo "<option value=\"软卧下铺\">软卧下铺</option>";
        echo "</select>";
        echo "<p>$info[19]</p>";
        echo "<select name=\"Seat2\">";
            if($info[24])
                  echo "<option value=\"硬座\">硬座</option>";
            if($info[25])
                echo "<option value=\"软座\">软座</option>";
            if($info[26])
                echo "<option value=\"硬卧上铺\">硬卧上铺</option>";
            if($info[27])
                echo "<option value=\"硬卧中铺\">硬卧中铺</option>";
            if($info[28])
                echo "<option value=\"硬卧下铺\">硬卧下铺</option>";
            if($info[29])
                echo "<option value=\"软卧上铺\">软卧上铺</option>";
            if($info[30])
                echo "<option value=\"软卧下铺\">软卧下铺</option>";
        echo "</select>";
        echo "<br>
          <input type=\"submit\" value=\"Submit\">
        </form>";

	?>

    <br>

    <br>
	<a  onclick="location.href='service_8.php'"><h4>查询订单</h4></a>
	<br>
	<a  onclick="location.href='../home/index.php'"><h2>退出登录</h2></a>

	<br>
	<a  onclick="location.href='../home/service.php'"><h2>返回服务页</h2></a>
	<br>
	<a  onclick="location.href='../home/service_4.php'"><h2>返回需求4查找页</h2></a>
</body>
</html>
