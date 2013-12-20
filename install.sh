#!/bin/sh

drop='drop table if exists answer; drop table if exists question; drop table if exists category; drop table if exists session; drop table if exists user;'
files=`cat app/user/sql/mysql/user.sql ./app/session/sql/mysql/session.sql app/category/sql/mysql/category.sql app/question/sql/mysql/question.sql app/question/sql/mysql/answer.sql backup.sql`

echo $drop $files | mysql -h192.168.1.222 -umrogacki -p mrogacki_quiz;

