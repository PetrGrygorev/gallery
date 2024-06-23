<?php

// класс подключения к БД
class DB						
{
    public static function link() {

    $host = HOST;
    $user = USER; 				   
    $password = PASSWORD;
    $db_name = DB_NAME; 				

    $db = new PDO("mysql:host=$host; dbname=$db_name;charset=UTF8",  $user, $password);

    return $db;
    }
}