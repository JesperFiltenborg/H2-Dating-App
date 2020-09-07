<?php

namespace App\Controllers;

use \Core\View;

/**
 * Home controller
 *
 * PHP version 7.0
 */
class Home extends \Core\Controller
{

    /**
     * Show the index page
     *
     * @return void
     */
    public function indexAction()
    {
        View::renderTemplate('base.html', [
            "log_setting"   => "Login"
        ]);
    }
    public function swipe_pageAction(){
        if(isset($_SESSION["LoginState"])&&$_SESSION["LoginState"] == 1){
            View::renderTemplate('Home/Swipe_Page.html',[
                "log_setting"   => "Logout",
                "baseUrl"       => $_SESSION["htmlPath"]
            ]);
        }
        else{
            $_SESSION["LoginState"] = 0;
            header('Location: '."/login");
            die();
        }
    }
}