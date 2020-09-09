<?php

namespace App\Controllers;

use App\Models\LoggedIn;
use App\Models\sql;
use \Core\View;
use \Core\Model;
/**
 * Login controller
 *
 * PHP version 7.0
 */
class Login extends \Core\Controller
{
    public function login_LoginAction()
    {
        $_SESSION["htmlPath"] = "http://".$_SERVER['HTTP_HOST']."/";
        View::renderTemplate('Home/login_page.html',[
            "log_setting"   => "Login",
            "baseUrl"       => $_SESSION["htmlPath"]
        ]);
    }
    public function login_attemptAction(){
        $acc_data = sql::db_Select("datingapph2","account","password, secretKey","username='".$_POST["username"]."'");
        if(hash("sha256",$_POST["password"].$acc_data["secretKey"])!=$acc_data["password"]){
            header('Location: '.$_SESSION["htmlPath"]."login");
            die();
        }
        $_SESSION["LoginState"] = 1;
        $acc_data = sql::db_Select("datingapph2","account","email, profileID, id","password='".$acc_data["password"]."'");
        $_SESSION["acc_id"] = $acc_data["id"];
        if($acc_data["email"] == null)
            header('Location: ' . $_SESSION["htmlPath"] . "create/account");
        elseif ($acc_data["profileID"] == null)
            header('Location: ' . $_SESSION["htmlPath"] . "create/profile");
        else
            $_SESSION["profile_id"] = $acc_data["profileID"];
            header('Location: '.$_SESSION["htmlPath"]."swipe_page");
    }
    public function logout_attemptAction(){
        //todo Make a function to check the database for matching username and password
        $_SESSION["LoginState"] = 0;
        unset($_SESSION["acc_id"]);
unset($_SESSION["profile_id"]);
        header('Location: '.$_SESSION["htmlPath"]);
        die();
    }
}
