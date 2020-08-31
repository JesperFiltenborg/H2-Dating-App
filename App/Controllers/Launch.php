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
class Launch extends \Core\Controller
{

    /**
     * Show the index page
     *
     * @return void
     */
    public function login_launchAction()
    {
        View::renderTemplate('Home/index.html');
    }
}
