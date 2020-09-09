<?php

namespace App\Controllers;

use App\Models\LoggedIn;
use App\Models\sql;
use \Core\View;
use \Core\Model;
use http\Message;

/**
 * Login controller
 *
 * PHP version 7.0
 */
class database extends \Core\Controller
{
    private function REQ($values = []){
        foreach ($values as $parameter){
            if(!array_key_exists($parameter,$_POST)){
                echo sprintf("Parameter %s not found",$parameter);
                die();
            }
        }
    }
    private static function generateRandomString($length = 32) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    public function insertNewLoginAction(){
        $this->REQ(["username","password","2password"]);
        if($_POST["password"] != $_POST["2password"])
            header('Location: '.$_SESSION["htmlPath"]."create/login");
        $secretKey =self::generateRandomString(10);

        $password = hash("sha256",$_POST["password"].$secretKey);
        sql::db_Insert("datingapph2","account", [
            "username"=>$_POST["username"],
            "password"=>$password,
            "secretKey"=>$secretKey
        ]);
        $_SESSION["acc_id"] = sql::db_Select("datingapph2","account","id","password='".$password."'");
        $_SESSION["LoginState"] = 1;
        header('Location: '.$_SESSION["htmlPath"]."create/account");
    }
}
