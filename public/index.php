<?php

use app\controllers\AuthController;
use app\controllers\MenuController;
use tn\phpmvc\Application;
use app\controllers\SiteController;

require_once __DIR__ . '/../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

$config = [
    'userClass' => \app\models\User::class,
    'db' => [
        'dsn' => $_ENV['DB_DSN'],
        'user' => $_ENV['DB_USER'],
        'password' => $_ENV['DB_PASSWORD']
    ]
];
;

$app = new Application(dirname(__DIR__), $config);
$app->router->get('/',[SiteController::class,'home']);
$app->router->get('/about',[SiteController::class,'about']);
$app->router->get('/contact',[SiteController::class,'contact']);
$app->router->post('/contact',[SiteController::class,'contact']);
$app->router->get('/admin',[SiteController::class,'dashboard']);

$app->router->get('/register',[AuthController::class,'register']);
$app->router->post('/register',[AuthController::class,'register']);

$app->router->get('/login',[AuthController::class,'login']);
$app->router->post('/login',[AuthController::class,'login']);

$app->router->get('/profile',[AuthController::class,'profile']);
$app->router->get('/logout',[AuthController::class,'logout']);

$app->router->get('/menu',[MenuController::class,'menu']);
$app->router->get('/menuitem',[MenuController::class,'menuitem']);
$app->router->get('/menuitems',[MenuController::class,'menus']);
$app->router->get('/admin_dishes_add',[MenuController::class,'add_menu']);



$app->run();

