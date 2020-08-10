<?php


namespace App\Models;
use App\Config;


class sql
{
    public static function db_Insert($database, $table, $data){
        $connection = new \mysqli(Config::DB_NAME,Config::DB_HOST,Config::DB_PASSWORD,$database) or die("Unable to connect to database");
        echo "Database connection works";
    }
}