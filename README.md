# Booking-System
A train ticket booking System

## Screenshots
![Home Page](https://github.com/BrannyA/Booking-System/blob/master/screenshot/home.png)


## Usage
#### Requirements
postgresql10, apache2, php5.6

#### Start and login postgresql
        $ sudo service postgresql start
        $ sudo -u postgres psql
        postgres=# create user root with createdb superuser
        createrole login;
        postgres=# create database root owner root;
        postgres=# \q  

#### Create database, create tables and import data
        $ psql 
        root=# create database tpch;
        CREATE DATABASE
        root=# \q
        $ psql -d tpch
        tpch=# <enter create table statements>
        tpch=# <enter statements to copy data> (see db.sql)

#### Set password, add login config and restart the service 
      $ psql    
      root=# ALTER USER dbms WITH PASSWORD 'dbms';
      root=# \q  
      # vi /etc/postgresql/10/main/pg_hba.conf
      -> # TYPE  DATABASE        USER            ADDRESS                 METHOD
      -> local   all             dbms                                    md5
      # service postgresql restart

Start server `$ sudo service apache2 start` and visit URL  `http://localhost:8080/`


## (虚假的)更新日志
2020/04/30 php基本框架完成(还没有测试qvq)，美化了登陆页面，明晚meeting <br>
2020/05/13 01:30 基本上都阔以啦哈哈哈哈哈哈哈开心，这么丑的代码一定不是我写的（逃 <br>
2020/05/13 23:45 修好了一些小bug，美化页面 <br>
2020/05/14 验收完成~感谢各位大佬╭(●｀∀´●)╯╰(●’◡’●)╮
