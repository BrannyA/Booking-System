<!DOCTYPE html>
<html>
<title>
    取消订单
</title>

<body>
    <h1 align="center">取消订单确认页</h1>
    <?php
        $R_ID = $_GET["R_ID"];
        $Train_ID = $_GET["train_id"];
        $departure_station = $_GET["d_station"];
        $arrive_station = $_GET["a_station"];
        $date = $_GET["date"];
        $Seattype = $_GET["type"];
        session_start();
        $username=$_SESSION["Username"];
        echo "<br>username = $username";
		echo "<br>date = $date";
        echo "<br>RID = $R_ID";
        echo "<br>dSta = $departure_station";
        echo "<br>sSta = $arrive_station";
		echo "<br>type = $type";

    	// Connecting, selecting database
    	$dbconn = pg_connect("dbname=tpch user=dbms password=dbms")
        or die('Could not connect: ' . pg_last_error());

        $cancel_ticket = "
        update Ticket
        set T_num_hardT=
                                case
                                when '$Seattype'='硬卧上铺' and T_num_hardT<5 then T_num_hardT+1 else  T_num_hardT
                                end,
            T_num_hardB=
                                case
                                    when '$Seattype'='硬卧下铺' and T_num_hardB<5 then T_num_hardB+1 else T_num_hardB
                                end,
            T_num_hardM=
                                case
                                    when '$Seattype'='硬卧中铺' and T_num_hardM<5 then T_num_hardM+1 else T_num_hardM
                                end,
            T_num_softT=
                                case
                                    when '$Seattype'='软卧上铺' and T_num_softT<5 then T_num_softT+1 else T_num_softT
                                end,
            T_num_softB=
                                case
                                    when '$Seattype'='软卧下铺' and T_num_softB<5 then T_num_softB+1 else T_num_softB
                                end,
            T_num_soft_seat=
                                case
                                    when '$Seattype'='软座' and T_num_soft_seat<5 then T_num_soft_seat+1 else T_num_soft_seat
                                end,
            T_num_hard_seat=
                                case
                                    when '$Seattype'='硬座' and T_num_hard_seat<5 then T_num_hard_seat+1 else T_num_hard_seat
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
        $cancel_reservation = "
            update Reservation
			set R_status='已取消订单'
            where R_ID= '$R_ID';
        ";
        $result_tick_cancel = pg_query($cancel_ticket) or die('Ticket cancel failed: ' . pg_last_error());
        $result_res_cancel = pg_query($cancel_reservation) or die('Reservation cancel failed: ' . pg_last_error());
        if($result_res_cancel && $result_tick_cancel){
            echo "<p>订单 $R_ID 取消成功<p>";
        }
    	// Closing connection
        pg_close($dbconn);
        ////继续写操作

    ?>

    <br>
    <a  onclick="location.href='../home/index.php'"><h2>退出登录</h2></a>

    <br>
    <a  onclick="location.href='../search/service.php'"><h2>返回服务页</h2></a>
    <br>
    <a  onclick="location.href='service_8.php'"><h2>返回需求8查找页</h2></a>
</body>
</html>
