<?php

/**
 * Front controller
 *
 * PHP version 7.0
 */

/**
 * Composer
 */
require dirname(__DIR__) . '/vendor/autoload.php';


/**
 * Error and Exception handling
 */
error_reporting(E_ALL);
set_error_handler('Core\Error::errorHandler');
set_exception_handler('Core\Error::exceptionHandler');


/**
 * Routing
 */
$router = new Core\Router();

// Add the routes
$router->add('', ['controller' => 'Home', 'action' => 'index']);
//login
$router->add('login', ['controller' => 'Login', 'action' => 'login_Login']);
$router->add('login/attempt', ['controller' => 'Login', 'action' => 'login_attempt']);
$router->add('logout', ['controller' => 'Login', 'action' => 'logout_attempt']);

//Test OF Database
$router->add('TestDB', ['controller' => 'Home', 'action' => 'testDB']);

//Access when logged in
$router->add('create/account', ['controller' => 'Create', 'action' => 'Create_Account']);
$router->add('create/login', ['controller' => 'Create', 'action' => 'Create_Login']);
$router->add('create/profile', ['controller' => 'Create', 'action' => 'Create_Profile']);
$router->add('profile', ['controller' => 'Login', 'action' => 'profile_page']);
$router->add('swipe_page', ['controller' => 'Home', 'action' => 'swipe_page']);
$router->add('matches', ['controller' => 'Login', 'action' => 'matches_page']);

//Database Routes
$router->add('database/create/login', ['controller' => 'database', 'action' => 'insertNewLogin']);
$router->add('database/create/account', ['controller' => 'database', 'action' => 'insertNewAccount']);
$router->add('database/create/profile', ['controller' => 'database', 'action' => 'insertNewProfile']);
$router->add('database/like', ['controller' => 'database', 'action' => 'doLike']);


$router->add('{controller}/{action}');
    
$router->dispatch($_SERVER['QUERY_STRING']);
