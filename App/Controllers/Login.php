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
        $_SESSION["htmlPath"] = $_SERVER['HTTP_REFERER'];
        View::renderTemplate('Home/login_page.html',[
            "log_setting"   => "Login",
            "baseUrl"       => $_SESSION["htmlPath"]
        ]);
    }
    public function login_attemptAction(){
        $params = $GLOBALS["_GET"];
        //todo Make a function to check the database for matching username and password
        $_SESSION["LoginState"] = 1;
        header('Location: '.$_SESSION["htmlPath"]."create/account");
        die();
    }
}