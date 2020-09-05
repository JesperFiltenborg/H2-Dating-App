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
        View::renderTemplate('Home/Create_Account.html',[
            "log_setting" => "",
            "baseUrl"       => $_SESSION["htmlPath"]
        ]);
    }
    public function Create_ProfileAction()
    {
        View::renderTemplate('Home/Create_Profile.html',[
            "log_setting" => "Logout",
            "baseUrl"       => $_SESSION["htmlPath"]
        ]);
    }
}