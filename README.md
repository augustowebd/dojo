# dojo

## require
php 7.2+
composer php

## install
cd ./dojo-php
composer install
composer docker-up

## create and load  database
00-ddl-dojo.sql
01-dml-dojo.sql
02-ddl-dojo.sql

## configure application: es
php-dojo/config/elasticSearch.php

## configure application: postgres
php-dojo/configg/postgres.php

## configure application: redis
php-dojo/config/redis.php
