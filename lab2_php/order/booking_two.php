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
        // $info = $_POST["info"];

		$line0 = $_POST["line_0"];
		$line1 = $_POST["line_1"];
		$line2 = $_POST["line_2"];
		$line3 = $_POST["line_3"];
		$line4 = $_POST["line_4"];
		$line5 = $_POST["line_5"];
		$line6 = $_POST["line_6"];
		$line7 = $_POST["line_7"];
		$line8 = $_POST["line_8"];
		$line9 = $_POST["line_9"];
		$line10 = $_POST["line_10"];
		$line11 = $_POST["line_11"];
		$line12 = $_POST["line_12"];
		$line13 = $_POST["line_13"];
		$line14 = $_POST["line_14"];
		$line15 = $_POST["line_15"];
		$line16 = $_POST["line_16"];
		$line17 = $_POST["line_17"];
		$line18 = $_POST["line_18"];
        $line19 = $_POST["line_19"];
		$line20 = $_POST["line_20"];
		$line21 = $_POST["line_21"];
		$line22 = $_POST["line_22"];
		$line23 = $_POST["line_23"];
		$line24 = $_POST["line_24"];
		$line25 = $_POST["line_25"];
		$line26 = $_POST["line_26"];
		$line27 = $_POST["line_27"];
		$line28 = $_POST["line_28"];
		$line29 = $_POST["line_29"];
		$line30 = $_POST["line_30"];
		$line31 = $_POST["line_31"];
		$line32 = $_POST["line_32"];
		$line33 = $_POST["line_33"];
		$line34 = $_POST["line_34"];
		$line35 = $_POST["line_35"];
		$line36 = $_POST["line_36"];
		$line37 = $_POST["line_37"];
		$line38 = $_POST["line_38"];
		$line39 = $_POST["line_39"];
		$line40 = $_POST["line_40"];
		$line41 = $_POST["line_41"];
		$line42 = $_POST["line_42"];
		$line43 = $_POST["line_43"];
		$info = array($line0,$line1,$line2,$line3,$line4,$line5,$line6,$line7,$line8,$line9,$line10,
						$line11,$line12,$line13,$line14,$line15,$line16,$line17,$line18,$line19,$line20,
						$line21,$line22,$line23,$line24,$line25,$line26,$line27,$line28,$line29,$line30,
						$line31,$line32,$line33,$line34,$line35,$line36,$line37,$line38,$line39,$line40,
						$line41,$line42,$line43);
		$date_1 = $_POST["date"];
        $date_2 = $_POST["date2"];
        $seat1 = $_POST["Seat1"];
        $seat2 = $_POST["Seat2"];

        $Train_ID = $info[0];
        $departure_station = $info[1];
        $arrive_station = $info[2];
        $Train_ID2 = $info[19];
        $departure_station2 = $info[20];
        $arrive_station2 = $info[21];

        if($seat1 == "硬座") $price1 = $info[12];
        else if($seat1 == "软座") $price1 = $info[13];
        else if($seat1 == "硬卧上铺") $price1 = $info[14];
        else if($seat1 == "硬卧中铺") $price1 = $info[15];
        else if($seat1 == "硬卧下铺") $price1 = $info[16];
        else if($seat1 == "软座上铺") $price1 = $info[17];
        else if($seat1 == "软座下铺") $price1 = $info[18];

        if($seat2 == "硬座") $price2 = $info[31];
        else if($seat2 == "软座") $price2 = $info[32];
        else if($seat2 == "硬卧上铺") $price2 = $info[33];
        else if($seat2 == "硬卧中铺") $price2 = $info[34];
        else if($seat2 == "硬卧下铺") $price2 = $info[35];
        else if($seat2 == "软座上铺") $price2 = $info[36];
        else if($seat2 == "软座下铺") $price2 = $info[37];
        // $Train_ID = $_GET["trainid"];
        // $date = $_GET["date"];
        // $departure_station = $_GET["from_station"];
        // $arrive_station = $_GET["to_station"];
        // $Seattype = $_GET["type"];
		// $price = $_GET["price"];

        $R_ID = $Train_ID.$date_1.$seat1.$username;
        $R_ID2 = $Train_ID2.$date_2.$seat2.$username;

		echo "<br>username = $username";
		echo "<br>RID = $R_ID";
		echo "<br>tid = $Train_ID";
		echo "<br>date1 = $date_1";
		echo "<br>from = $departure_station";
		echo "<br>to = $arrive_station";
		echo "<br>seat1 = $seat1";
		echo "<br>price1 = $price1";

		echo "<br>RID2 = $R_ID2";
		echo "<br>tid2 = $Train_ID2";
		echo "<br>date2 = $date_2";
		echo "<br>from = $departure_station2";
		echo "<br>to = $arrive_station2";
		echo "<br>seat2 = $seat2";
		echo "<br>price2 = $price2";

		// Connecting, selecting database
		$dbconn = pg_connect("dbname=tpch user=dbms password=dbms")
	    or die('Could not connect: ' . pg_last_error());

		$update_ticket1 = "
		update Ticket
			set T_num_hardT=
									case
									when '$seat1'='硬卧上铺' and T_num_hardT>0 then T_num_hardT-1 else  T_num_hardT
									end,
				T_num_hardB=
									case
										when '$seat1'='硬卧下铺' and T_num_hardB>0 then T_num_hardB-1 else T_num_hardB
									end,
				T_num_hardM=
									case
										when '$seat1'='硬卧中铺' and T_num_hardM>0 then T_num_hardM-1 else T_num_hardM
									end,
				T_num_softT=
									case
										when '$seat1'='软卧上铺' and T_num_softT>0 then T_num_softT-1 else T_num_softT
									end,
				T_num_softB=
									case
										when '$seat1'='软卧下铺' and T_num_softB>0 then T_num_softB-1 else T_num_softB
									end,
				T_num_soft_seat=
									case
										when '$seat1'='软座' and T_num_soft_seat>0 then T_num_soft_seat-1 else T_num_soft_seat
									end,
				T_num_hard_seat=
									case
										when '$seat1'='硬座' and T_num_hard_seat>0 then T_num_hard_seat-1 else T_num_hard_seat
									end
			from Pass as P1,Pass as P2,Pass as P3
			where Ticket.T_date =
                                case
								when (P2.P_DAY-P1.P_DAY)=0 then '$date_1'::date
								when (P2.P_DAY-P1.P_DAY)=1 then'$date_1'::date + INTERVAL'1 day'
								when (P2.P_DAY-P1.P_DAY)=2 then '$date_1'::date + INTERVAL'2 day'
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

        $update_reservarion1 = "
			insert into Reservation
			values ('$R_ID', '已确认订单','$date_1','$date_1','$username','$arrive_station','$departure_station','$Train_ID','$seat1',$price1);
        ";

        $update_ticket2 = "
		update Ticket
		set T_num_hardT=
								case
								when '$seat2'='硬卧上铺' and T_num_hardT>0 then T_num_hardT-1 else  T_num_hardT
								end,
			T_num_hardB=
								case
									when '$seat2'='硬卧下铺' and T_num_hardB>0 then T_num_hardB-1 else T_num_hardB
								end,
			T_num_hardM=
								case
									when '$seat2'='硬卧中铺' and T_num_hardM>0 then T_num_hardM-1 else T_num_hardM
								end,
			T_num_softT=
								case
									when '$seat2'='软卧上铺' and T_num_softT>0 then T_num_softT-1 else T_num_softT
								end,
			T_num_softB=
								case
									when '$seat2'='软卧下铺' and T_num_softB>0 then T_num_softB-1 else T_num_softB
								end,
			T_num_soft_seat=
								case
									when '$seat2'='软座' and T_num_soft_seat>0 then T_num_soft_seat-1 else T_num_soft_seat
								end,
			T_num_hard_seat=
								case
									when '$seat2'='硬座' and T_num_hard_seat>0 then T_num_hard_seat-1 else T_num_hard_seat
								end
		from Pass as P1,Pass as P2,Pass as P3
		where Ticket.T_date =
							case
							when (P2.P_DAY-P1.P_DAY)=0 then '$date_2'::date
							when (P2.P_DAY-P1.P_DAY)=1 then'$date_2'::date + INTERVAL'1 day'
							when (P2.P_DAY-P1.P_DAY)=2 then '$date_2'::date + INTERVAL'2 day'
							end
		and Ticket.T_TrainID='$Train_ID2'
		and P1.P_TrainID= '$Train_ID2'
		and P2.P_TrainID='$Train_ID2'
		and P3.P_TrainID='$Train_ID2'
		and P1.P_Stationname='$departure_station2'
		and P3.P_Stationname='$arrive_station2'
		and P2.P_stationNum<P3.P_stationNum
		and P2.P_stationNum>=P1.P_stationNum
		and Ticket.T_Stationname=P2.P_Stationname;
        ";

        $update_reservarion2 = "
            insert into Reservation
            values ('$R_ID2', '已确认订单','$date_2','$date_2','$username','$arrive_station2','$departure_station2','$Train_ID2','$seat2',$price2);
        ";

		$result_res1 = pg_query($update_reservarion1) or die('Reservation update failed: ' . pg_last_error());
        $result_tick1 = pg_query($update_ticket1) or die('Ticket update failed: ' . pg_last_error());
		if (!$result_tick1 || !$result_res1){
			echo "<p>$Train_ID 预定失败</p>";
		}
		else{
			echo "<p>$Train_ID 预定成功</p>";
		    echo "<p>订单号$R_ID</p>";
		}

		$result_res2 = pg_query($update_reservarion2) or die('Reservation update failed: ' . pg_last_error());
        $result_tick2 = pg_query($update_ticket2) or die('Ticket update failed: ' . pg_last_error());
        if (!$result_tick2 || !$result_res2){
            echo "<p>$Train_ID2 预定失败</p>";
        }
        else{
            echo "<p>$Train_ID2 预定成功</p>";
            echo "<p>订单号$R_ID2</p>";
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
