su - postgres

psql

CREATE DATABASE lab2 OWNER root;

GRANT ALL PRIVILEGES ON DATABASE lab2 to root;

CREATE TYPE se_type as enum
(
    '硬卧上铺','硬卧中铺','硬卧下铺','软卧上铺','软卧下铺','硬座','软座'
);

CREATE TYPE Res_status as enum
(
    '已确认订单','已取消订单'
);

create table Station( S_ID    integer not null,
                      S_name  varchar(20) primary key,
                      S_city  varchar(10) not null
                    );

create table Train( ID    varchar(10) not null,
                    Type  varchar(10) not null,
					primary key(ID)
                  );

create table Pass( P_totalTime          integer,
                   P_day                integer,
                   P_arrivalTime        time,
                   P_departureTime      time,
				   P_stationNum         integer,
				   P_TrainID            varchar(10) not null,
				   P_Stationname        varchar(20) not null,
                   P_price_hardT       decimal(15,2),
                   P_price_hardM       decimal(15,2),
                   P_price_hardB       decimal(15,2),
                   P_price_softT       decimal(15,2),
                   P_price_softB       decimal(15,2),
                   P_price_soft_seat   decimal(15,2),
                   P_price_hard_seat   decimal(15,2),
				   foreign key (P_TrainID) references Train(ID),
				   foreign key (P_Stationname) references Station(S_name)
                 );

create table Ticket( T_num_hardT         integer,
                     T_num_hardM         integer,
					 T_num_hardB         integer,
					 T_num_softT         integer,
					 T_num_softB         integer,
					 T_num_soft_seat     integer,
					 T_num_hard_seat     integer,
					 T_date        		 date,
					 T_TrainID           varchar(10) not null,
                     T_stationname       varchar(20) not null,
					 foreign key (T_TrainID) references Train(ID),
                     foreign key (T_stationname) references Station(S_name)
                   );

create table TrainUser( U_user_name     varchar(20) not null,
				   U_ID            char(18) unique,
                   U_real_name     varchar(20) not null,

				   U_phone_number  char(11) unique,
				   U_creditcard    char(16) not null,
				   primary key(U_user_name)
                 );

create table Reservation ( R_ID                 varchar(30) primary key,
                           R_status             Res_status not null,
						   R_start_date         date not null,
						   R_book_date          date not null,
						   R_username 			varchar(20) not null,
						   R_arrive_station     varchar(20),
						   R_departure_station  varchar(20),
						   R_TrainID            varchar(10) not null,
						   R_Seattype           se_type,
						   R_price              decimal(15,2),
						   foreign key (R_username) references TrainUser(U_user_name),
						   foreign key (R_arrive_station) references Station(S_name),
						   foreign key (R_departure_station) references Station(S_name),
						   foreign key (R_TrainID) references Train(ID)
                         );

COPY Station

FROM '/home/dbms/lab2_php/data/station-data.csv'

WITH (FORMAT csv);

COPY Train

FROM '/var/www/html/lab2_php_new/data/train-data.csv'

WITH (FORMAT csv);

COPY Ticket

FROM '/var/www/html/lab2_php_new/data/ticket-data.csv'

WITH (FORMAT csv);

COPY Pass

FROM '/var/www/html/lab2_php_new/data/pass-data.csv'

WITH (FORMAT csv);
