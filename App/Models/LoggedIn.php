<?php


namespace App\Models;


class LoggedIn
{
    public static function login($state, $accountID, $password){
        $_SESSION["LoginState"] = 1;
    }
}