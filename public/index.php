<?php

require_once('../vendor/autoload.php');

use app\controllers\SiteController;
use app\controllers\UserController;
use app\core\Application;

$app = new Application(dirname(__DIR__));

$app->router->get('/', [SiteController::class, 'index']);

// UserController
$app->router->get('/users', [UserController::class, 'index']);
$app->router->post('/users', [UserController::class, 'store']);
// !UserController

$app->run();
