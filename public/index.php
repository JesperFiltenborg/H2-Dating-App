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
$router->add('login', ['controller' => 'Launch', 'action' => 'login_launch']);
$router->add('logged_on', ['controller' => 'Launch', 'action' => 'login_check']);
$router->add('login/{password:\.}', ['controller' => 'Launch', 'action' => 'login_action']);

//Access when logged in
$router->add('profile', ['controller' => 'Launch', 'action' => 'profile_page']);
$router->add('swipe_page', ['controller' => 'Launch', 'action' => 'swipe_page']);
$router->add('matches', ['controller' => 'Launch', 'action' => 'matches_page']);
$router->add('{controller}/{action}');
    
$router->dispatch($_SERVER['QUERY_STRING']);
