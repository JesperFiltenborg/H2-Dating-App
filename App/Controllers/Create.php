<?php

namespace App\Controllers;

use \Core\View;

/**
 * Create controller
 *
 * PHP version 7.0
 */
class Create extends \Core\Controller
{

    /**
     * Show the index page
     *
     * @return void
     */
    public function Create_LoginAction(){
        View::renderTemplate('Home/Create_Login_Info.html',[
            "log_setting" => "",
            "baseUrl"       => $_SESSION["htmlPath"]
        ]);
    }
    public function Create_AccountAction()
    {
        if(isset($_SESSION["LoginState"])&&$_SESSION["LoginState"] == 1){
            View::renderTemplate('Home/Create_Account.html',[
                "log_setting" => "",
                "baseUrl"       => $_SESSION["htmlPath"]
            ]);
        }
        else{
            $_SESSION["LoginState"] = 0;
            unset($_SESSION["acc_id"]);
            header('Location: '."/login");
            die();
        }
    }
    public function Create_ProfileAction()
    {
        if(isset($_SESSION["LoginState"])&&$_SESSION["LoginState"] == 1){
            View::renderTemplate('Home/Create_Profile.html',[
                "log_setting" => "Logout",
                "baseUrl"       => $_SESSION["htmlPath"]
            ]);
        }
        else{
            $_SESSION["LoginState"] = 0;
            unset($_SESSION["acc_id"]);
            header('Location: '."/login");
            die();
        }
    }
}