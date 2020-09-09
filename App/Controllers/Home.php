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
            unset($_SESSION["profile_id"]);
            View::renderTemplate('base.html', [
                "log_setting"   => "Login"
            ]);
        }
    }
    public function swipe_pageAction(){
        if(isset($_SESSION["LoginState"])&&$_SESSION["LoginState"] == 1){

            $userData = sql::db_Select("datingapph2","profile","*","id='".$_SESSION["profile_id"]."'");
            $where = sprintf("age>'%s' And age<'%s'",$userData["age"]-5,$userData["age"]+5);

            if($userData["sex"] == "Woman"){
                $where = sprintf("%s And sex='Man'",$where);
            }elseif($userData["sex"] == "Man"){
                $where = sprintf("%s And sex='Woman'",$where);
            }

            $matchesID = sql::db_Select1("datingapph2","matchtable","*",sprintf("(reqID='%s' OR requestedID='%s') AND isMatch='1'",$_SESSION["profile_id"],$_SESSION["profile_id"]));
            $matchesID = array_filter($matchesID);

            $matches = [];
            $refrence = sql::db_Select1("datingapph2","profile","*",$where);
            $refrence = array_filter($refrence);

            foreach ($matchesID as $match){
                if(isset($refrence[$match["reqID"]])){
                    $matches[$match["reqID"]] = $refrence[$match["reqID"]];
                    unset($refrence[$match["reqID"]]);
                }elseif(isset($refrence[$match["requestedID"]])){
                    $matches[$match["requestedID"]] = $refrence[$match["requestedID"]];
                    unset($refrence[$match["requestedID"]]);
                }
            }

            View::renderTemplate('Home/Swipe_Page.html',[
                "log_setting"   => "Logout",
                "baseUrl"       => $_SESSION["htmlPath"],
                "refreces"      => $refrence,
                "matches"       => $matches
            ]);
        }
        else{
            $_SESSION["LoginState"] = 0;
            unset($_SESSION["acc_id"]);
            unset($_SESSION["profile_id"]);
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