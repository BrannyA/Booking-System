<!DOCTYPE html>
<html>
<title>
	查找车次
</title>
<head>
    <link rel="stylesheet" type="text/css" href="../style/general.css" />
</head>
<body>
	<h1 align="center">车次的查询结果如下</h1>
	<div class="container">
		<div class="box1">
			<?php
				$ID = $_POST["ID"];
				$date = $_POST["date"];
				session_start();
				$username = $_SESSION["Username"];
				// $userid = $_SESSION["userid"];
				echo "<br>用户$username 您好<br>";
				// echo "<a href=\"../order/booking.php?date=$date&trainid=$ID&from_station='0'&to_station='ToExample'&type='softB'&price='888'\">booking</a>";

				// Connecting, selecting database
				$dbconn = pg_connect("dbname=tpch user=dbms password=dbms")
				or die('Could not connect: ' . pg_last_error());
				$query_firstSta = "
					select  P_Stationname,P_departureTime
					from Pass
					where   Pass.P_TrainID='$ID'
							and Pass.P_stationNum=1;
					";
				$query = "
					select T3.stationNum,T3.Stationname
					,P2.P_arrivalTime
					,P2.P_departureTime
					,case
							when T1.T_num_hard_seat >=0 and T2.T_num_hard_seat >=0  then T3.num_hard_seat
							else null
					end as hard_seat_num
					,case
							when T1.T_num_soft_seat >=0 and T2.T_num_soft_seat >=0  then T3.num_soft_seat
							else null
					end as soft_seat_num
					,case
							when T1.T_num_hardT >=0 and T2.T_num_hardT >=0  then T3.num_hardT
							else null
					end as hardT_num
					,case
							when T1.T_num_hardM >=0 and T2.T_num_hardM >=0  then T3.num_hardM
							else null
					end as hardM_num
					,case
							when T1.T_num_hardB >=0 and T2.T_num_hardB >=0  then T3.num_hardB
							else null
					end as hardB_num
					,case
							when T1.T_num_softT >=0 and T2.T_num_softT >=0  then T3.num_softT
							else null
					end as softT_num
					,case
							when T1.T_num_softB >=0 and T2.T_num_softB >=0  then T3.num_softB
							else null
					end as softB_num
					,P2.P_price_hard_seat
					,P2.P_price_soft_seat
					,P2.P_price_hardT
					,P2.P_price_hardM
					,P2.P_price_hardB
					,P2.P_price_softT
					,P2.P_price_softB

					from (
							select P1.P_TrainID as Train_ID,
							P1.P_stationNum as stationNum,
							P1.P_Stationname as Stationname,
							min(Ticket.T_num_hardT) as num_hardT,
							min(Ticket.T_num_hardM)as num_hardM,
							min(Ticket.T_num_hardB)as num_hardB,
							min(Ticket.T_num_softT)as num_softT,
							min(Ticket.T_num_softB)as num_softB,
							min(Ticket.T_num_soft_seat)as num_soft_seat,
							min(Ticket.T_num_hard_seat)as num_hard_seat
							from Ticket,Pass as P1,Pass as P2
							where
							P1.P_TrainID='$ID'
							and P2.P_TrainID='$ID'
							and Ticket.T_TrainID='$ID'
							and P1.P_stationNum>1
							and P1.P_stationNum>P2.P_stationNum
							and P2.P_stationNum>=1
							and Ticket.T_date=
												case when P2.P_DAY=0 then '$date'::date
													when P2.P_DAY=1 then '$date'::date+ INTERVAL'1 day'
													when P2.P_DAY=2 then '$date'::date+ INTERVAL'2 day'
												end
							and Ticket.T_Stationname=P2.P_Stationname
							group by Train_ID,stationNum,Stationname
						) as T3,
						Ticket as T1,
						Ticket as T2,
						Pass as P1,
						Pass as P2

					where
							T1.T_TrainID='$ID'
							and T2.T_TrainID='$ID'
							and T1.T_date='$date'::date
							and T2.T_date=
											case when P2.P_DAY=0 then '$date'::date
													when P2.P_DAY=1 then '$date'::date+ INTERVAL'1 day'
													when P2.P_DAY=2 then '$date'::date+ INTERVAL'2 day'
												end
							and P1.P_TrainID='$ID'
							and P2.P_TrainID='$ID'
							and P1.P_stationNum=1
							and P2.P_stationNum=T3.stationNum
							and P1.P_Stationname=T1.T_Stationname
							and P2.P_Stationname=T2.T_Stationname
					order by T3.stationNum;
				";
				$s0 = pg_query($query_firstSta) or die('Query failed: ' . pg_last_error());
				$result = pg_query($query) or die('Query failed: ' . pg_last_error());
				$row_num = pg_num_rows($result);
				if($row_num == 0){
					echo "没有符合要求的车次";
				}
				else{
					echo "$date 开车的车次$ID 的经停站信息如下，各座位的信息为[余票|票价]，点击可购买";
					echo "<table>\n";
					echo "<tr>";
					echo "<td>站号</td>" ;
					echo "<td>站名</td>" ;
					echo "<td>到达时间</td>" ;
					echo "<td>出发时间</td>";
					echo "<td>硬座</td>" ;
					echo "<td>软座</td>" ;
					echo "<td>硬卧上</td>";
					echo "<td>硬卧中</td>" ;
					echo "<td>硬卧下</td>" ;
					echo "<td>软卧上</td>" ;
					echo "<td>软卧下</td>";
					echo "</tr>";
					$sline = pg_fetch_array($s0, null, PGSQL_BOTH);
					echo "<tr>
						<td>1</td>
						<td>$sline[0]</td>
						<td>--</td>
						<td>$sline[1]</td>
						<td>--</td>
						<td>--</td>
						<td>--</td>
						<td>--</td>
						<td>--</td>
						<td>--</td>
						<td>--</td>
					</tr>";
					while ($line = pg_fetch_array($result, null, PGSQL_BOTH)) {
						echo "\t<tr>\n";
						for ($i = 0; $i < 4; $i++) {
							echo "<td> $line[$i] </td>";
						}
						for ($i = 4; $i < 11; $i++){
							$temp = $i + 7;
							if($line[$i] == 0)
								echo "<td>无票</td>";
							elseif($i == 4)
								echo "<td><a href=\"../order/booking.php?date=$date&trainid=$ID&from_station=$sline[0]&to_station=$line[1]&type=硬座&price=$line[$temp]\"> $line[$i]|$line[$temp]</a></td>";
							elseif($i == 5)
								echo "<td><a href=\"../order/booking.php?date=$date&trainid=$ID&from_station=$sline[0]&to_station=$line[1]&type=软座&price=$line[$temp]\"> $line[$i]|$line[$temp]</a></td>";
							elseif($i == 6)
								echo "<td><a href=\"../order/booking.php?date=$date&trainid=$ID&from_station=$sline[0]&to_station=$line[1]&type=硬卧上铺&price=$line[$temp]\"> $line[$i]|$line[$temp]</a></td>";
							elseif($i == 7)
								echo "<td><a href=\"../order/booking.php?date=$date&trainid=$ID&from_station=$sline[0]&to_station=$line[1]&type=硬卧中铺&price=$line[$temp]\"> $line[$i]|$line[$temp]</a></td>";
							elseif($i == 8)
								echo "<td><a href=\"../order/booking.php?date=$date&trainid=$ID&from_station=$sline[0]&to_station=$line[1]&type=硬卧下铺&price=$line[$temp]\"> $line[$i]|$line[$temp]</a></td>";
							elseif($i == 9)
								echo "<td><a href=\"../order/booking.php?date=$date&trainid=$ID&from_station=$sline[0]&to_station=$line[1]&type=软卧上铺&price=$line[$temp]\"> $line[$i]|$line[$temp]</a></td>";
							else //if($i == 10):
								echo "<td><a href=\"../order/booking.php?date=$date&trainid=$ID&from_station=$sline[0]&to_station=$line[1]&type=软卧下铺&price=$line[$temp]\"> $line[$i]|$line[$temp]</a></td>";
						}
						echo "\t</tr>\n";
					}
					echo "</table>\n";
					echo "<br>";

				}

				// Free resultset
				pg_free_result($result);
				// Closing connection
				pg_close($dbconn);

			?>
			<br>
			<button type="button"><a  onclick="location.href='../home/index.php'"><h3>退出登录</h3></a></button>


			<button type="button"><a  onclick="location.href='service.php'"><h3>返回服务页</h3></a></button>

			<button type="button"><a  onclick="location.href='service_4.php'"><h3>返回需求4查找页</h3></a></button>
	    </div>
	</div>
</body>
</html>
