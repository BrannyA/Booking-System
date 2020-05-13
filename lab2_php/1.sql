select T3.stationNum,T3.Stationname
,P2.P_departureTime
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
        P1.P_TrainID='1095'
        and P2.P_TrainID='1095'
        and Ticket.T_TrainID='1095'
        and P1.P_stationNum>1
        and P1.P_stationNum>P2.P_stationNum
        and P2.P_stationNum>=1
        and Ticket.T_date=
                            case when P2.P_DAY=0 then '2020-05-01'::date
                                when P2.P_DAY=1 then '2020-05-01'::date+ INTERVAL'1 day'
                                when P2.P_DAY=2 then '2020-05-01'::date+ INTERVAL'2 day'
                            end
        and Ticket.T_Stationname=P2.P_Stationname
        group by Train_ID,stationNum,Stationname
    ) as T3,
    Ticket as T1,
    Ticket as T2,
    Pass as P1,
    Pass as P2

where
        T1.T_TrainID='1095'
        and T2.T_TrainID='1095'
        and T1.T_date='2020-05-01'::date
        and T2.T_date=
                        case when P2.P_DAY=0 then '2020-05-01'::date
                                when P2.P_DAY=1 then '2020-05-01'::date+ INTERVAL'1 day'
                                when P2.P_DAY=2 then '2020-05-01'::date+ INTERVAL'2 day'
                            end
        and P1.P_TrainID='1095'
        and P2.P_TrainID='1095'
        and P1.P_stationNum=1
        and P2.P_stationNum=T3.stationNum
        and P1.P_Stationname=T1.T_Stationname
        and P2.P_Stationname=T2.T_Stationname
order by T3.stationNum;
