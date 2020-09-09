<?php

namespace App\Controllers;

use App\Models\sql;
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
        if(isset($_SESSION["LoginState"])&&$_SESSION["LoginState"] == 1){
            View::renderTemplate('Home/Swipe_Page.html',[
                "log_setting"   => "Logout",
                "baseUrl"       => $_SESSION["htmlPath"]
            ]);
        }
        else{
            $_SESSION["LoginState"] = 0;
            unset($_SESSION["acc_id"]);
            View::renderTemplate('base.html', [
                "log_setting"   => "Login"
            ]);
        }
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
            unset($_SESSION["acc_id"]);
            header('Location: '."/login");
            die();
        }
    }

    //Demo of DB function use cases
    public function testDBAction(){
        $database = "sp_test";
        $table = "tblfilm";
        $filmName = "test2";
        $FilmReleaseDate = date("Y-m-d");
        $FilmRunTimeMinutes = 120;
        echo sql::db_Insert(
            $database,
            $table,
            [
                "FilmName"=>$filmName,
                "FilmReleaseDate"=>$FilmReleaseDate,
                "FilmRunTimeMinutes"=>$FilmRunTimeMinutes
            ]);
        /*
        echo sql::db_Select(
            $database,
            $table,
            "*",
            "FilmName='".$filmName."' AND FilmRunTimeMinutes='".$FilmRunTimeMinutes."'"
        );*/
        echo sql::db_Update($database,$table,"FilmName='test991'","FilmName='".$filmName."' AND FilmRunTimeMinutes='120'");
    }
}