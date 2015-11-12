create database nowall_tasks;

use nowall_tasks;

grant all on nowall_tasks.* to testuser@localhost identified by '9999';

create table tasks(
  id int primary key auto_increment,
  name varchar (255),
  created_at datetime,
  updated_at datetime);


