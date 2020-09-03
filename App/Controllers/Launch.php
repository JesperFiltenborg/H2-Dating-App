<?php

namespace App\Controllers;

use App\Models\LoggedIn;
use App\Models\sql;
use \Core\View;
use \Core\Model;
/**
 * Home controller
 *
 * PHP version 7.0
 */
class Launch extends \Core\Controller
{

    /**
     * Show the index page
     *
     * @return void
     */
    public function login_launchAction()
    {
        if(isset($_SESSION["LoginState"]) && $_SESSION["LoginState"] != 1){
            View::renderTemplate('Home/login_page.html',[
                "log_setting" => "login"
            ]);
        }else{
            LoggedIn::login(1,"1","1");
        }

    }
}
