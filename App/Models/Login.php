<?php

namespace App\Models;

use PDO;

/**
 * Login model
 *
 * PHP version 7.0
 */
class Login extends \Core\Model
{

    /**
     * Get all the users as an associative array
     *
     * @return array
     */
    public static function check_login(){
        if(isset( $_SESSION["LoginState"]) &&  $_SESSION["LoginState"] == 1){

        }else{
            header('Location: login');
            die();
        }
    }
}
