create database if not exists shop default charset utf8;

use shop;

create table if not exists shop_user(
id int not null primary key auto_increment,
username varchar(50) not null unique '用户名',
userpwd char(32) not null comment '密码',
nickname varchar(50) comment '',
userpic varchar(255),
status tinyint not null default 1,
level tinyint not null default 0
)engine=myisam default charset=utf8;

create table if not exists shop_user_details(
id int not null auto_increment primary key,
uid int not null,
gold int not null,
sex tinyint not null default 3,
email varchar(255) unique,
regtime int not null,
lasttime int not null,
regip varchar(255) not null
)engine=myisam default charset=utf8;

create table if not exists shop_types(
id int not null auto_increment primary key,
typename varchar(50) not null unique,
pid int not null,
path varchar(255) not null
)engine=myisam default charset=utf8;

create table if not exists shop_goods(
id int not null auto_increment primary key,
goodsname varchar(255) not null,
tid int not null,
goodspic varchar(255) not null,
goodsprice float(10,2) not null,
goodsnum int not null,
goodsdes text,
status tinyint not null default 1
)engine=myisam default charset=utf8;

create table if not exists shop_order(
id int not null auto_increment primary key,
ordernum int not null,
uid int not null,
gid int not null,
goodsprice float(10,2) not null
)engine=myisam default charset=utf8;

create table if not exists shop_order_status(
id int not null auto_increment primary key,
ordernum int not null,
status tinyint not null default 0
)engine=myisam default charset=utf8;

create table if not exists shop_goods_comment(
id int not null auto_increment primary key,
gid int not null,
uid int not null,
content text,
posttime int
)engine=myisam default charset=utf8;

create table if not exists shop_friendlink(
id int not null auto_increment primary key,
linkname varchar(255) not null unique,
linkurl varchar(255) not null,
status tinyint not null default 0
)engine=myisam default charset=utf8;

create table if not exists shop_webconf(
id int not null auto_increment primary key,
webname varchar(255) not null,
logo varchar(255) not null,
keywords varchar(255) not null,
description varchar(255) not null,
status tinyint not null default 1
)engine=myisam default charset=utf8;