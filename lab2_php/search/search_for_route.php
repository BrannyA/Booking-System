<!DOCTYPE html>
<html>
<title>
	查询两地间车次
</title>
<head>
    <link rel="stylesheet" type="text/css" href="../style/general.css" />
</head>
<body>
	<h1 align="center">欢迎使用火车订票系统的查询两地之间的车次!</h1>
	<div class="container">
		<div class="box1">
			<?php
				$departureCity = $_POST["departureCity"];
				$arrivalCity = $_POST["arrivalCity"];
				$date = $_POST["date"];
				$departureTime = $_POST["departureTime"];
				session_start();
				$username = $_SESSION["Username"];
				echo "<br>用户$username 您好";
				echo "<br>$date $departureTime 从$departureCity 到$arrivalCity 的车次信息如下";
				echo "<br>";
				// echo "<a href=\"../order/booking.php?date=$date&trainid=idExample&from_station=fromExample&to_station=toExample&type='hardT'\">booking</a>";

				// Connecting, selecting database
				$dbconn = pg_connect("dbname=tpch user=dbms password=dbms")
				or die('Could not connect: ' . pg_last_error());

				$query_direct = "
					select
					T3.Train_ID,
					T3.Stationname_1,T3.Stationname_2
					,P1.P_departureTime
					,P2.P_arrivalTime
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
					end as softB_num,
					(P2.P_price_hard_seat-P1.P_price_hard_seat)as hard_seat_price,
					(P2.P_price_soft_seat-P1.P_price_soft_seat)as soft_seat_price,
					(P2.P_price_hardT-P1.P_price_hardT)as hardT_price,
					(P2.P_price_hardM-P1.P_price_hardM)as hardM_price,
					(P2.P_price_hardB-P1.P_price_hardB)as hardB_price,
					(P2.P_price_softT-P1.P_price_softT)as softT_price,
					(P2.P_price_softB-P1.P_price_softB)as softB_price,
					(P2.P_totalTime-P1.P_totalTime)as Total_Time,
					(
						case
						when T1.T_num_hard_seat>=0 and T2.T_num_hard_seat>=0 and T3.num_hard_seat>0 then P2.P_price_hard_seat-P1.P_price_hard_seat
						when T1.T_num_soft_seat>=0 and T2.T_num_soft_seat>=0 and T3.num_soft_seat>0 then P2.P_price_soft_seat-P1.P_price_soft_seat
						when T1.T_num_hardT>=0 and T2.T_num_hardT>=0 and T3.num_hardT>0  then  P2.P_price_hardT-P1.P_price_hardT
						when T1.T_num_hardM>=0 and T2.T_num_hardM>=0 and T3.num_hardM>0 then  P2.P_price_hardM-P1.P_price_hardM
						when T1.T_num_hardB>=0 and T2.T_num_hardB>=0 and T3.num_hardB>0 then  P2.P_price_hardB-P1.P_price_hardB
						when T1.T_num_softT>=0 and T2.T_num_softT>=0 and T3.num_softT>0   then  P2.P_price_softT-P1.P_price_softT
						when T1.T_num_softB>=0 and T2.T_num_softB>=0 and T3.num_softB>0   then  P2.P_price_softB-P1.P_price_softB
						end
					)as price_min
					from (
							select P1.P_TrainID as Train_ID,
							P1.P_stationNum as stationNum_1,
							P1.P_Stationname as Stationname_1,
							P2.P_stationNum as stationNum_2,
							P2.P_Stationname as Stationname_2,
							min(Ticket.T_num_hardT) as num_hardT,
							min(Ticket.T_num_hardM)as num_hardM,
							min(Ticket.T_num_hardB)as num_hardB,
							min(Ticket.T_num_softT)as num_softT,
							min(Ticket.T_num_softB)as num_softB,
							min(Ticket.T_num_soft_seat)as num_soft_seat,
							min(Ticket.T_num_hard_seat)as num_hard_seat
							from Ticket,Pass as P1,Pass as P2,Station as S1, Station as S2,Pass as P3
							where
								S1.S_city='$departureCity'
								and S2.S_city='$arrivalCity'
								and P1.P_Stationname=S1.S_name
								and P2.P_Stationname=S2.S_name
								and P1.P_TrainID=P2.P_TrainID
								and P1.P_departureTime>='$departureTime'
								and P1.P_stationNum<P2.P_stationNum
								and Ticket.T_TrainID=P1.P_TrainID
								and Ticket.T_date=
									case
									when (P3.P_DAY-P1.P_DAY)=0 then '$date'::date
									when (P3.P_DAY-P1.P_DAY)=1 then'$date'::date + INTERVAL'1 day'
									when (P3.P_DAY-P1.P_DAY)=2 then '$date'::date + INTERVAL'2 day'
									end
								and P3.P_TrainID=P1.P_TrainID
								and P3.P_stationNum>=P1.P_stationNum
								and P3.P_stationNum<P2.P_stationNum
								and Ticket.T_Stationname=P3.P_Stationname
							group by Train_ID,stationNum_1,Stationname_1,stationNum_2,Stationname_2
					) as T3,
						Ticket as T1,
						Ticket as T2,
						Pass as P1,
						Pass as P2
					where
							T1.T_TrainID=T3.Train_ID
							and T2.T_TrainID=T3.Train_ID
							and T1.T_date='$date'::date
							and T2.T_date=case
								when P2.P_DAY-P1.P_DAY=0 then '$date'::date
								when P2.P_DAY-P1.P_DAY=1 then '$date'::date + INTERVAL'1 day'
								when P2.P_DAY-P1.P_DAY=2 then '$date'::date + INTERVAL'2 day' end
							and P1.P_TrainID=T3.Train_ID
							and P2.P_TrainID=T3.Train_ID
							and P1.P_stationNum=T3.stationNum_1
							and P2.P_stationNum=T3.stationNum_2
							and P1.P_Stationname=T1.T_Stationname
							and P2.P_Stationname=T2.T_Stationname
							and (
								(T1.T_num_hardT>=0 and T2.T_num_hardT>=0 and T3.num_hardT>0)
								or(T1.T_num_hardM>=0 and T2.T_num_hardM>=0 and T3.num_hardM>0)
								or(T1.T_num_hardB>=0 and T2.T_num_hardB>=0 and T3.num_hardB>0)
								or(T1.T_num_softB>=0 and T2.T_num_softB>=0 and T3.num_softB>0)
								or(T1.T_num_softT>=0 and T2.T_num_softT>=0 and T3.num_softT>0)
								or (T1.T_num_hard_seat>=0 and T2.T_num_hard_seat>=0 and T3.num_hard_seat>0)
								or(T1.T_num_soft_seat>=0 and T2.T_num_soft_seat>=0 and T3.num_soft_seat>0)
								)
					order by    price_min,
								Total_Time,
								P1.P_departureTime
					limit 10;
					";
				$query_transfer = "
					select
					T3.Train_ID_1,
					T3.Stationname_1,
					T3.Stationname_2
					,P1.P_departureTime
					,P2.P_arrivalTime
					,case
							when T1.T_num_hard_seat >=0 and T2.T_num_hard_seat >=0  then T3.num_hard_seat_1
							else null
					end as hard_seat_num_1
					,case
							when T1.T_num_soft_seat >=0 and T2.T_num_soft_seat >=0  then T3.num_soft_seat_1
							else null
					end as soft_seat_num_1
					,case
							when T1.T_num_hardT >=0 and T2.T_num_hardT >=0  then T3.num_hardT_1
							else null
					end as hardT_num_1
					,case
							when T1.T_num_hardM >=0 and T2.T_num_hardM >=0  then T3.num_hardM_1
							else null
					end as hardM_num_1
					,case
							when T1.T_num_hardB >=0 and T2.T_num_hardB >=0  then T3.num_hardB_1
							else null
					end as hardB_num_1
					,case
							when T1.T_num_softT >=0 and T2.T_num_softT >=0  then T3.num_softT_1
							else null
					end as softT_num_1
					,case
							when T1.T_num_softB >=0 and T2.T_num_softB >=0  then T3.num_softB_1
							else null
					end as softB_num_1,
					(P2.P_price_hard_seat-P1.P_price_hard_seat)as hard_seat_price_1,
					(P2.P_price_soft_seat-P1.P_price_soft_seat)as soft_seat_price_1,
					(P2.P_price_hardT-P1.P_price_hardT)as hardT_price_1,
					(P2.P_price_hardM-P1.P_price_hardM)as hardM_price_1,
					(P2.P_price_hardB-P1.P_price_hardB)as hardB_price_1,
					(P2.P_price_softT-P1.P_price_softT)as softT_price_1,
					(P2.P_price_softB-P1.P_price_softB)as softB_price_1,
					T3.Train_ID_2,
					T3.Stationname_3,
					T3.Stationname_4,
					P4.P_departureTime,
					P5.P_arrivalTime,
					case
							when T4.T_num_hard_seat >=0 and T5.T_num_hard_seat >=0  then T3.num_hard_seat_2
							else null
					end as hard_seat_num_2
					,case
							when T4.T_num_soft_seat >=0 and T5.T_num_soft_seat >=0  then T3.num_soft_seat_2
							else null
					end as soft_seat_num_2
					,case
							when T4.T_num_hardT >=0 and T5.T_num_hardT >=0  then T3.num_hardT_2
							else null
					end as hardT_num_2
					,case
							when T4.T_num_hardM >=0 and T5.T_num_hardM >=0  then T3.num_hardM_2
							else null
					end as hardM_num_2
					,case
							when T4.T_num_hardB >=0 and T5.T_num_hardB >=0  then T3.num_hardB_2
							else null
					end as hardB_num_2
					,case
							when T4.T_num_softT >=0 and T5.T_num_softT >=0  then T3.num_softT_2
							else null
					end as softT_num_2
					,case
							when T4.T_num_softB >=0 and T5.T_num_softB >=0  then T3.num_softB_2
							else null
					end as softB_num_2,
					(P5.P_price_hard_seat-P4.P_price_hard_seat)as hard_seat_price_2,
					(P5.P_price_soft_seat-P4.P_price_soft_seat)as soft_seat_price_2,
					(P5.P_price_hardT-P4.P_price_hardT)as hardT_price_2,
					(P5.P_price_hardM-P4.P_price_hardM)as hardM_price_2,
					(P5.P_price_hardB-P4.P_price_hardB)as hardB_price_2,
					(P5.P_price_softB-P4.P_price_softB)as softB_price_2,
					(P5.P_price_softT-P4.P_price_softT)as softT_price_2,
					(
						case
						when T1.T_num_hard_seat>=0 and T2.T_num_hard_seat>=0 and T3.num_hard_seat_1>0 then P2.P_price_hard_seat-P1.P_price_hard_seat
						when T1.T_num_soft_seat>=0 and T2.T_num_soft_seat>=0 and T3.num_soft_seat_1>0 then P2.P_price_soft_seat-P1.P_price_soft_seat
						when T1.T_num_hardT>=0 and T2.T_num_hardT>=0 and T3.num_hardT_1>0  then  P2.P_price_hardT-P1.P_price_hardT
						when T1.T_num_hardM>=0 and T2.T_num_hardM>=0 and T3.num_hardM_1>0 then  P2.P_price_hardM-P1.P_price_hardM
						when T1.T_num_hardB>=0 and T2.T_num_hardB>=0 and T3.num_hardB_1>0 then  P2.P_price_hardB-P1.P_price_hardB
						when T1.T_num_softT>=0 and T2.T_num_softT>=0 and T3.num_softT_1>0   then  P2.P_price_softT-P1.P_price_softT
						when T1.T_num_softB>=0 and T2.T_num_softB>=0 and T3.num_softB_1>0   then  P2.P_price_softB-P1.P_price_softB
						end
					)as price_min_1,
					(
						case
						when T4.T_num_hard_seat>=0 and T5.T_num_hard_seat>=0 and T3.num_hard_seat_2>0 then P5.P_price_hard_seat-P4.P_price_hard_seat
						when T4.T_num_soft_seat>=0 and T5.T_num_soft_seat>=0 and T3.num_soft_seat_2>0 then P5.P_price_soft_seat-P4.P_price_soft_seat
						when T4.T_num_hardT>=0 and T5.T_num_hardT>=0 and T3.num_hardT_2>0  then  P5.P_price_hardT-P4.P_price_hardT
						when T4.T_num_hardM>=0 and T5.T_num_hardM>=0 and T3.num_hardM_2>0 then  P5.P_price_hardM-P4.P_price_hardM
						when T4.T_num_hardB>=0 and T5.T_num_hardB>=0 and T3.num_hardB_2>0 then  P5.P_price_hardB-P4.P_price_hardB
						when T4.T_num_softT>=0 and T5.T_num_softT>=0 and T3.num_softT_2>0   then  P5.P_price_softT-P4.P_price_softT
						when T4.T_num_softB>=0 and T5.T_num_softB>=0 and T3.num_softB_2>0   then  P5.P_price_softB-P4.P_price_softB
						end
					)as price_min_2,
					(P2.P_totalTime-P1.P_totalTime)as Total_Time_1,
					(P5.P_totalTime-P4.P_totalTime)as Total_Time_2,
					(P2.P_totalTime-P1.P_totalTime+P5.P_totalTime-P4.P_totalTime)as Total_Time,
					((
						case
						when T1.T_num_hard_seat>=0 and T2.T_num_hard_seat>=0 and T3.num_hard_seat_1>0 then P2.P_price_hard_seat-P1.P_price_hard_seat
						when T1.T_num_soft_seat>=0 and T2.T_num_soft_seat>=0 and T3.num_soft_seat_1>0 then P2.P_price_soft_seat-P1.P_price_soft_seat
						when T1.T_num_hardT>=0 and T2.T_num_hardT>=0 and T3.num_hardT_1>0  then  P2.P_price_hardT-P1.P_price_hardT
						when T1.T_num_hardM>=0 and T2.T_num_hardM>=0 and T3.num_hardM_1>0 then  P2.P_price_hardM-P1.P_price_hardM
						when T1.T_num_hardB>=0 and T2.T_num_hardB>=0 and T3.num_hardB_1>0 then  P2.P_price_hardB-P1.P_price_hardB
						when T1.T_num_softT>=0 and T2.T_num_softT>=0 and T3.num_softT_1>0   then  P2.P_price_softT-P1.P_price_softT
						when T1.T_num_softB>=0 and T2.T_num_softB>=0 and T3.num_softB_1>0   then  P2.P_price_softB-P1.P_price_softB
						end
					)+(
						case
						when T4.T_num_hard_seat>=0 and T5.T_num_hard_seat>=0 and T3.num_hard_seat_2>0 then P5.P_price_hard_seat-P4.P_price_hard_seat
						when T4.T_num_soft_seat>=0 and T5.T_num_soft_seat>=0 and T3.num_soft_seat_2>0 then P5.P_price_soft_seat-P4.P_price_soft_seat
						when T4.T_num_hardT>=0 and T5.T_num_hardT>=0 and T3.num_hardT_2>0  then  P5.P_price_hardT-P4.P_price_hardT
						when T4.T_num_hardM>=0 and T5.T_num_hardM>=0 and T3.num_hardM_2>0 then  P5.P_price_hardM-P4.P_price_hardM
						when T4.T_num_hardB>=0 and T5.T_num_hardB>=0 and T3.num_hardB_2>0 then  P5.P_price_hardB-P4.P_price_hardB
						when T4.T_num_softT>=0 and T5.T_num_softT>=0 and T3.num_softT_2>0   then  P5.P_price_softT-P4.P_price_softT
						when T4.T_num_softB>=0 and T5.T_num_softB>=0 and T3.num_softB_2>0   then  P5.P_price_softB-P4.P_price_softB
						end
					))as price_min,
					T3.date_2

					from (
							select P1.P_TrainID as Train_ID_1,
							P1.P_stationNum as stationNum_1,
							P1.P_Stationname as Stationname_1,
							P2.P_stationNum as stationNum_2,
							P2.P_Stationname as Stationname_2,
							min(T1.T_num_hardT) as num_hardT_1,
							min(T1.T_num_hardM)as num_hardM_1,
							min(T1.T_num_hardB)as num_hardB_1,
							min(T1.T_num_softT)as num_softT_1,
							min(T1.T_num_softB)as num_softB_1,
							min(T1.T_num_soft_seat)as num_soft_seat_1,
							min(T1.T_num_hard_seat)as num_hard_seat_1,
							P4.P_TrainID as Train_ID_2,
							P4.P_stationNum as stationNum_3,
							P4.P_Stationname as Stationname_3,
							P5.P_stationNum as stationNum_4,
							P5.P_Stationname as Stationname_4,
							min(T2.T_num_hardT) as num_hardT_2,
							min(T2.T_num_hardM)as num_hardM_2,
							min(T2.T_num_hardB)as num_hardB_2,
							min(T2.T_num_softT)as num_softT_2,
							min(T2.T_num_softB)as num_softB_2,
							min(T2.T_num_soft_seat)as num_soft_seat_2,
							min(T2.T_num_hard_seat)as num_hard_seat_2,
							T4.T_date as date_2
							from Ticket as T1,Pass as P1,Pass as P2,Station as S1, Station as S2,Pass as P3,
								Ticket as T2,Pass as P4,Pass as P5,Station as S4, Station as S5,Pass as P6,Ticket as T3,Ticket as T4
							where
								S1.S_city='$departureCity'
								and S5.S_city='$arrivalCity'
								and P1.P_TrainID!=P4.P_TrainID
								and P1.P_Stationname=S1.S_name
								and P2.P_Stationname=S2.S_name
								and P1.P_TrainID=P2.P_TrainID
								and P1.P_departureTime>='$departureTime'
								and P1.P_stationNum<P2.P_stationNum
								and T1.T_TrainID=P1.P_TrainID
								and T3.T_TrainID=P1.P_TrainID
								and T3.T_Stationname=P2.P_Stationname
								and T1.T_date=
													case
													when (P3.P_DAY-P1.P_DAY)=0 then '$date'::date
													when (P3.P_DAY-P1.P_DAY)=1 then'$date'::date + INTERVAL'1 day'
													when (P3.P_DAY-P1.P_DAY)=2 then '$date'::date + INTERVAL'2 day'
													end
								and T3.T_date=
												case
												when (P2.P_DAY-P1.P_DAY)=0 then '$date'::date
												when (P2.P_DAY-P1.P_DAY)=1 then'$date'::date + INTERVAL'1 day'
												when (P2.P_DAY-P1.P_DAY)=2 then '$date'::date + INTERVAL'2 day'
												end
								and P3.P_TrainID=P1.P_TrainID
								and P3.P_stationNum>=P1.P_stationNum
								and P3.P_stationNum<P2.P_stationNum
								and T1.T_Stationname=P3.P_Stationname
								and S2.S_city=S4.S_city
								and P4.P_Stationname=S4.S_name
								and P5.P_Stationname=S5.S_name
								and P4.P_TrainID=P5.P_TrainID
								and P4.P_stationNum<P5.P_stationNum
								and T4.T_TrainID=P4.P_TrainID
								and T4.T_Stationname=P4.P_Stationname
								and T2.T_TrainID=P4.P_TrainID
								and (
								S4.S_name=S2.S_name and
														(
															T4.T_date=T3.T_date and
															((P4.P_departureTime-P2.P_arrivalTime) between interval'1 hour' and  interval'4 hour')
															or
																T4.T_date=T3.T_date+INTERVAL'1 day' and
															((P2.P_departureTime-P4.P_arrivalTime) between interval'20 hour' and  interval'23 hour')
														)
							or S4.S_name!=S2.S_name and
														(
															T4.T_date=T3.T_date and
															((P4.P_departureTime-P2.P_arrivalTime) between interval'1 hour' and  interval'3 hour')
															or
																T4.T_date=T3.T_date+INTERVAL'1 day' and
															((P2.P_departureTime-P4.P_arrivalTime) between interval'21 hour' and  interval'23 hour')

														)
									)



								and T2.T_date=
													case
													when (P6.P_DAY-P4.P_DAY)=0 then T4.T_date
													when (P6.P_DAY-P4.P_DAY)=1 then T4.T_date::date + INTERVAL'1 day'
													when (P6.P_DAY-P4.P_DAY)=2 then T4.T_date::date + INTERVAL'2 day'
													end
								and P6.P_TrainID=P4.P_TrainID
								and P6.P_stationNum>=P4.P_stationNum
								and P6.P_stationNum<P5.P_stationNum
								and T2.T_Stationname=P6.P_Stationname
							group by Train_ID_1,stationNum_1,Stationname_1,stationNum_2,Stationname_2,
										Train_ID_2,stationNum_3,Stationname_3,stationNum_4,Stationname_4,date_2
						) as T3,
						Ticket as T1,
						Ticket as T2,
						Pass as P1,
						Pass as P2,
						Ticket as T4,
						Ticket as T5,
						Pass as P4,
						Pass as P5

					where
							T1.T_TrainID=T3.Train_ID_1
							and T2.T_TrainID=T3.Train_ID_1
							and T1.T_date='$date'::date
							and T2.T_date=
												case
													when (P2.P_DAY-P1.P_DAY)=0 then '$date'::date
													when (P2.P_DAY-P1.P_DAY)=1 then'$date'::date + INTERVAL'1 day'
													when (P2.P_DAY-P1.P_DAY)=2 then '$date'::date + INTERVAL'2 day'
												end
							and P1.P_TrainID=T3.Train_ID_1
							and P2.P_TrainID=T3.Train_ID_1
							and P1.P_stationNum=T3.stationNum_1
							and P2.P_stationNum=T3.stationNum_2
							and P1.P_Stationname=T1.T_Stationname
							and P2.P_Stationname=T2.T_Stationname
							and (
								(T1.T_num_hardT>=0 and T2.T_num_hardT>=0 and T3.num_hardT_1>0)
								or(T1.T_num_hardM>=0 and T2.T_num_hardM>=0 and T3.num_hardM_1>0)
								or(T1.T_num_hardB>=0 and T2.T_num_hardB>=0 and T3.num_hardB_1>0)
								or(T1.T_num_softB>=0 and T2.T_num_softB>=0 and T3.num_softB_1>0)
								or(T1.T_num_softT>=0 and T2.T_num_softT>=0 and T3.num_softT_1>0)
								or (T1.T_num_hard_seat>=0 and T2.T_num_hard_seat>=0 and T3.num_hard_seat_1>0)
								or(T1.T_num_soft_seat>=0 and T2.T_num_soft_seat>=0 and T3.num_soft_seat_1>0)
								)


							and T4.T_TrainID=T3.Train_ID_2
							and T5.T_TrainID=T3.Train_ID_2
							and T4.T_date=T3.date_2
							and T5.T_date=
											case
													when (P5.P_DAY-P4.P_DAY)=0 then T4.T_date
													when (P5.P_DAY-P4.P_DAY)=1 then T4.T_date::date + INTERVAL'1 day'
													when (P5.P_DAY-P4.P_DAY)=2 then T4.T_date::date + INTERVAL'2 day'
											end
							and P4.P_TrainID=T3.Train_ID_2
							and P5.P_TrainID=T3.Train_ID_2
							and P4.P_stationNum=T3.stationNum_3
							and P5.P_stationNum=T3.stationNum_4
							and P4.P_Stationname=T4.T_Stationname
							and P5.P_Stationname=T5.T_Stationname
							and (
								(T4.T_num_hardT>=0 and T5.T_num_hardT>=0 and T3.num_hardT_2>0)
								or(T4.T_num_hardM>=0 and T5.T_num_hardM>=0 and T3.num_hardM_2>0)
								or(T4.T_num_hardB>=0 and T5.T_num_hardB>=0 and T3.num_hardB_2>0)
								or(T4.T_num_softB>=0 and T5.T_num_softB>=0 and T3.num_softB_2>0)
								or(T4.T_num_softT>=0 and T5.T_num_softT>=0 and T3.num_softT_2>0)
								or (T4.T_num_hard_seat>=0 and T5.T_num_hard_seat>=0 and T3.num_hard_seat_2>0)
								or(T4.T_num_soft_seat>=0 and T5.T_num_soft_seat>=0 and T3.num_soft_seat_2>0)
								)
					order by price_min,
								Total_Time,
								P1.P_departureTime
					limit 10;
					";


		//直达车次查询
				$result_direct = pg_query($query_direct) or die('Query failed: ' . pg_last_error());
				$row_num = pg_num_rows($result_direct);
				if($row_num == 0){
					echo "<br>没有符合要求的直达车次<br>";
				}
				else{
					echo "<br><br>符合要求的直达车次如下，各座位的信息为[余票|票价]，点击可购买<br>";
					echo "<table>\n";
					echo "<tr>";
					echo "<td>车号</td>";
					echo "<td>起始站</td>" ;
					echo "<td>到达站</td>" ;
					echo "<td>出发时间</td>";
					echo "<td>到达时间</td>" ;
					echo "<td>硬座</td>" ;
					echo "<td>软座</td>" ;
					echo "<td>硬卧上</td>";
					echo "<td>硬卧中</td>" ;
					echo "<td>硬卧下</td>" ;
					echo "<td>软卧上</td>" ;
					echo "<td>软卧下</td>";
					echo "<td>总时间</td>";
					echo "</tr>";
					while ($line = pg_fetch_array($result_direct, null, PGSQL_BOTH)) {
						echo "\t<tr>\n";
						for ($i = 0; $i < 5; $i++) {
							echo "<td> $line[$i]</td>";
						}
						for ($i = 5; $i < 12; $i++){
							$temp = $i + 7;
							if(!$line[$i])
								echo "<td>无票</td>";
							elseif($i == 5)
								echo "<td><a href=\"../order/booking.php?date=$date&trainid=$line[0]&from_station=$line[1]&to_station=$line[2]&type=硬座&price=$line[$temp]\">$line[$i]|$line[$temp]</a></td>";
							elseif($i == 6)
								echo "<td><a href=\"../order/booking.php?date=$date&trainid=$line[0]&from_station=$line[1]&to_station=$line[2]&type=软座&price=$line[$temp]\">$line[$i]|$line[$temp]</a></td>";
							elseif($i == 7)
								echo "<td><a href=\"../order/booking.php?date=$date&trainid=$line[0]&from_station=$line[1]&to_station=$line[2]&type=硬卧上铺&price=$line[$temp]\">$line[$i]|$line[$temp]</a></td>";
							elseif($i == 8)
								echo "<td><a href=\"../order/booking.php?date=$date&trainid=$line[0]&from_station=$line[1]&to_station=$line[2]&type=硬卧中铺&price=$line[$temp]\">$line[$i]|$line[$temp]</a></td>";
							elseif($i == 9)
								echo "<td><a href=\"../order/booking.php?date=$date&trainid=$line[0]&from_station=$line[1]&to_station=$line[2]&type=硬卧下铺&price=$line[$temp]\">$line[$i]|$line[$temp]</a></td>";
							elseif($i == 10)
								echo "<td><a href=\"../order/booking.php?date=$date&trainid=$line[0]&from_station=$line[1]&to_station=$line[2]&type=软卧上铺&price=$line[$temp]\">$line[$i]|$line[$temp]</a></td>";
							elseif($i == 11)
								echo "<td><a href=\"../order/booking.php?date=$date&trainid=$line[0]&from_station=$line[1]&to_station=$line[2]&type=软卧下铺&price=$line[$temp]\">$line[$i]|$line[$temp]</a></td>";
						}
						echo "<td>$line[19]</td>";
						echo "\t</tr>\n";
					}
					echo "</table>\n";
					echo "<br>";
				}
				pg_free_result($result_direct);
				pg_close($dbconn);

				$dbconn = pg_connect("dbname=tpch user=dbms password=dbms")
				or die('Could not connect: ' . pg_last_error());
		// 换乘车次查询
				$result_transfer = pg_query($query_transfer) or die('Query failed: ' . pg_last_error());
				$row_num = pg_num_rows($result_transfer);
				if($row_num == 0){
					echo "没有符合要求的换乘车次";
				}
				else{
					echo "<br><br>符合要求的换乘车次如下，各座位的信息为[余票|票价]，点击选座订票购买<br>";
					echo "<table>\n";
					echo "<tr>";
					echo "<td>车号1</td>" ;
					echo "<td>起始站1</td>" ;
					echo "<td>到达站1</td>" ;
					echo "<td>出发时间1</td>";
					echo "<td>到达时间1</td>" ; //4
					echo "<td>车号2</td>" ;
					echo "<td>起始站2</td>" ;
					echo "<td>到达站2</td>" ;
					echo "<td>出发时间2</td>";
					echo "<td>到达时间2</td>" ;  //9
					echo "<td>总时间</td>"; //11
					echo "<td>价格</td>" ;
					echo "<td>选座订票</td>";
					echo "</tr>";
					while ($line = pg_fetch_array($result_transfer, null, PGSQL_BOTH)) {
						echo "\t<tr>\n";
						for ($i = 0; $i < 5; $i++) {
							echo "<td> $line[$i]</td>";
						}
						for ($i = 19; $i < 24; $i++) {
							echo "<td> $line[$i]</td>";
						}
						echo "<td>$line[42] 分</td>";
						echo "<td>$line[43] 起</td>";
						echo "<td><a href=\"../order/choose_seat.php?line_0=$line[0]&
									line_1=$line[1]&line_2=$line[2]&line_3=$line[3]&line_4=$line[4]&
									line_5=$line[5]&line_6=$line[6]&line_7=$line[7]&line_8=$line[8]&
									line_9=$line[9]&line_10=$line[10]&line_11=$line[11]&line_12=$line[12]&
									line_13=$line[13]&line_14=$line[14]&line_15=$line[15]&line_16=$line[16]&
									line_17=$line[17]&line_18=$line[18]&line_19=$line[19]&line_20=$line[20]&
									line_21=$line[21]&line_22=$line[22]&line_23=$line[23]&
									line_24=$line[24]&line_25=$line[25]&line_26=$line[26]&line_27=$line[27]&
									line_28=$line[28]&line_29=$line[29]&line_30=$line[30]&line_31=$line[31]&
									line_32=$line[32]&line_33=$line[33]&line_34=$line[34]&line_35=$line[35]&
									line_36=$line[36]&line_37=$line[37]&line_38=$line[38]&line_39=$line[39]&
									line_40=$line[40]&line_41=$line[41]&line_42=$line[42]&line_43=$line[43]&
									date2=$line[44]&date=$date\">选座订票</a></td>";
						// echo "<td><a href=\"../order/choose_seat.php?train1=$line[0]&fromS1=$line[1]&toS1=$line[2]&dtime1=$line[3]&atime1=$line[4]&train2=$line[5]&fromS2=$line[6]&toS2=$line[7]&dtime2=$line[8]&atime2=$line[9]&&type='hard_seat'\">选座订票</a></td>";
						}
						echo "\t</tr>\n";
						echo "</table>\n";
						echo "<br>";
					}
				// Free resultset
				pg_free_result($result_transfer);
				// Closing connection
				pg_close($dbconn);
				echo "<a href=\"service_6.php?from_station=$arrivalCity&to_station=$departureCity&date=$date\">查询返程车票</a>";
			?>
			<br>
			<button type="button"><a  onclick="location.href='../home/index.php'"><h2>退出登录</h2></a></button>

			<br>
			<button type="button"><a  onclick="location.href='service.php'"><h2>返回服务页</h2></a></button>
			<br>
			<button type="button"><a  onclick="location.href='service_5.php'"><h2>返回需求5查找页</h2></a></button>
		</div>
	</div>
</body>
</html>
