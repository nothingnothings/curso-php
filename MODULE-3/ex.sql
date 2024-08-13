



// basic MYSQL commands (use database, create, etc):

use mysql;
show databases;
create database test;
use test;
show tables;
create table test (id int, name varchar(20));
insert into test values (1, 'test');
select * from test;
drop table test;
drop database test;

// basic SQL commands (select, insert, update, delete):