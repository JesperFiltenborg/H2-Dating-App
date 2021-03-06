<?php


namespace App\Models;
use App\Config;


class sql
{
    //Todo Check The Insert function, and see if can be sql injected or optimized
    //SQL INSERT FUNCTION
    private static function get_arraykeys_as_string($data){
        $result = sprintf("%s",array_keys($data)[0]);
        unset($data[array_keys($data)[0]]);
        foreach (array_keys($data) as $value){
            $result = "$result,$value";
        }
        return $result;
    }
    private static function get_array_as_string($data){
        $result = sprintf("'%s'",$data[array_keys($data)[0]]);
        unset($data[array_keys($data)[0]]);
        foreach ($data as $value){
            $result = "$result,'$value'";
        }
        return $result;
    }
    public static function db_Insert($database, $table, $data)
    {
        $connection = new \mysqli(Config::DB_NAME, Config::DB_HOST, Config::DB_PASSWORD, $database) or die("Unable to connect to database");
        $datakeys = self::get_arraykeys_as_string($data);
        $datavalues = self::get_array_as_string($data);
        $statement = sprintf("INSERT INTO %s (%s) VALUES(%s)", $table, $datakeys, $datavalues);
        if ($connection->query($statement) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $statement . "<br>" . $connection->error;
        }
        $connection->close();
    }
    public static function db_Select($database, $table, $columns = "*", $where = ""){
        $connection = new \mysqli(Config::DB_NAME, Config::DB_HOST, Config::DB_PASSWORD, $database) or die("Unable to connect to database");
        $result =  $connection->query(sprintf("SELECT %s FROM %s WHERE %s",$columns,$table,$where));
        $connection->close();
        return $result->fetch_assoc();
    }
    public static function db_Select1($database, $table, $columns = "*", $where = ""){
        $connection = new \mysqli(Config::DB_NAME, Config::DB_HOST, Config::DB_PASSWORD, $database) or die("Unable to connect to database");
        $result =  $connection->query(sprintf("SELECT %s FROM %s ORDER BY id DESC",$columns,$table));
        $results = [];
        $count = (int)$result->fetch_assoc()["id"];

        for ($i = 1; $i <= $count; $i++) {
            $value = $connection->query(sprintf("SELECT %s FROM %s WHERE id='%s' and %s",$columns,$table,$i,$where));
            if($value != false){
                $results[$i] = $value->fetch_assoc();
            }
        }
        $connection->close();
        return $results;
    }

    public static function db_Update($database, $table, $columns, $where = ""){
        $connection = new \mysqli(Config::DB_NAME, Config::DB_HOST, Config::DB_PASSWORD, $database) or die("Unable to connect to database");
        $result = $connection->query(sprintf("UPDATE %s SET %s WHERE %s",$table,$columns,$where)) or die("Unable to Update database");
        $connection->close();
    }
}