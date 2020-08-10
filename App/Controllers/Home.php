<?php

namespace App\Controllers;

use App\Models\sql;
use \Core\View;
use \Core\Model;
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
        sql::db_Insert("sp_test","tblFilm",["FilmName"=>"Testmovie2","FilmReleaseDate"=>date("Y/m/d"),"FilmRunTimeMinutes"=>60]);
        die();
        View::renderTemplate('Home/index.html');
    }
}
