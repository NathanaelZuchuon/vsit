<?php

session_start();
$host = "http://vsit.bhent.org/vsit/";

require_once __DIR__ . '/core/Model.php';
require_once __DIR__ . '/core/Router.php';
require_once __DIR__ . '/core/Controller.php';
require_once __DIR__ . '/core/errorHandler.php';
require_once __DIR__ . '/helpers/passwordEncryption.php';

require './controllers/homeController.php';
require './controllers/loginController.php';
require './controllers/dashboardController.php';

$router = new Router();

$router->add('/home', 'homeController');
$router->add('/login', 'loginController');
$router->add('/dashboard', 'homeController');

$router->submit();
