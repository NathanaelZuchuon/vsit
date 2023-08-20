<?php

require_once __DIR__ . '/vendor/autoload.php';

use vsit\core\{Model, Router, Controller, errorHandler};
use vsit\helpers\{passwordEncryption};

$router = new Router();

$router->add('/home', 'homeController');
$router->add('/login', 'loginController');
$router->add('/dashboard', 'dashboardController');

session_start();
$router->submit();