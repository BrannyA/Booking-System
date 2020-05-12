<!DOCTYPE html>
<html>
<title>
	订单确认
</title>

<body>
	<h1 align="center">订单确认</h1>
	<?php
        session_start();
        $username = $_SESSION["Username"];
        $userid = $_SESSION["userid"];

        $Train_ID = $_GET["trainid"];
        $date = $_GET["date"];
        $departure_station = $_GET["from_station"];
        $arrive_station = $_GET["to_station"];
        $Seattype = $_GET["type"];
		$price = $_GET["price"];
        $R_ID = $Train_ID.$date.$Seattype.$username;
		echo "<br>username = $username";
		echo "<br>tid = $Train_ID";
		echo "<br>date = $date";
		echo "<br>RID = $R_ID";
		echo "<br>dSta = $departure_station";
		echo "<br>sSta = $arrive_station";
		echo "<br>type = $Seattype";
		echo "<br>price = $price";
		echo "<br>";
		// Connecting, selecting database
		$dbconn = pg_connect("dbname=tpch user=dbms password=dbms")
	    or die('Could not connect: ' . pg_last_error());

		$update_ticket = "
		update Ticket
			set T_num_hardT=
									case
									when '$Seattype'='硬卧上铺' and T_num_hardT>0 then T_num_hardT-1 else  T_num_hardT
									end,
				T_num_hardB=
									case
										when '$Seattype'='硬卧下铺' and T_num_hardB>0 then T_num_hardB-1 else T_num_hardB
									end,
				T_num_hardM=
									case
										when '$Seattype'='硬卧中铺' and T_num_hardM>0 then T_num_hardM-1 else T_num_hardM
									end,
				T_num_softT=
									case
										when '$Seattype'='软卧上铺' and T_num_softT>0 then T_num_softT-1 else T_num_softT
									end,
				T_num_softB=
									case
										when '$Seattype'='软卧下铺' and T_num_softB>0 then T_num_softB-1 else T_num_softB
									end,
				T_num_soft_seat=
									case
										when '$Seattype'='软座' and T_num_soft_seat>0 then T_num_soft_seat-1 else T_num_soft_seat
									end,
				T_num_hard_seat=
									case
										when '$Seattype'='硬座' and T_num_hard_seat>0 then T_num_hard_seat-1 else T_num_hard_seat
									end
			from Pass as P1,Pass as P2,Pass as P3
			where Ticket.T_date =
                                case
								when (P2.P_DAY-P1.P_DAY)=0 then '$date'::date
								when (P2.P_DAY-P1.P_DAY)=1 then'$date'::date + INTERVAL'1 day'
								when (P2.P_DAY-P1.P_DAY)=2 then '$date'::date + INTERVAL'2 day'
								end
			and Ticket.T_TrainID='$Train_ID'
			and P1.P_TrainID= '$Train_ID'
			and P2.P_TrainID='$Train_ID'
			and P3.P_TrainID='$Train_ID'
			and P1.P_Stationname='$departure_station'
			and P3.P_Stationname='$arrive_station'
			and P2.P_stationNum<P3.P_stationNum
			and P2.P_stationNum>=P1.P_stationNum
			and Ticket.T_Stationname=P2.P_Stationname;
		";

        $update_reservarion = "
			insert into Reservation
			values ('$R_ID', '已确认订单','$date','$date','$username','$arrive_station','$departure_station','$Train_ID','$Seattype',$price);
        ";
		$result_res = pg_query($update_reservarion) or die('预定失败 不可以预定两张一样的座位 Reservation update failed: ' . pg_last_error());
        $result_tick = pg_query($update_ticket)
			or die('预定失败 不可以预定两张一样的座位: ' . pg_last_error());
		if (!$result_tick || !$result_res){
			echo "<p>预定失败</p>";
		}
		else{
			echo "<p>预定成功</p>";
		    echo "<p>订单号$R_ID</p>";
		}
		// Closing connection
		pg_close($dbconn);
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
