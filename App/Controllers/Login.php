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
        if(isset($_SESSION["LoginState"]) && $_SESSION["LoginState"] == 1){
            View::renderTemplate('Home/login_page.html',[
                "log_setting" => "Login"
            ]);
        }else{
            LoggedIn::login(1,"1","1");
        }
    }
    public function login_attemptAction(){
        $params = $GLOBALS["_GET"];
        //todo Make a function to check the database for matching username and password
        $_SESSION["LoginState"] = 1;
    }
}
