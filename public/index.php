<?php

use app\controllers\AuthController;
use app\controllers\MenuController;
use tn\phpmvc\Application;
use app\controllers\SiteController;

require_once __DIR__ . '/../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->safeLoad();

if (!getenv('DB_DSN')) {
    putenv("DB_DSN=$_ENV[DB_DSN]");
    putenv("DB_USER=$_ENV[DB_USER]");
    putenv("DB_PASSWORD=$_ENV[DB_PASSWORD]");
    putenv("MAIL_HOST=$_ENV[MAIL_HOST]");
    putenv("MAIL_USERNAME=$_ENV[MAIL_USERNAME]");
    putenv("MAIL_PASSWORD=$_ENV[MAIL_PASSWORD]");
    putenv("MAIL_PORT=$_ENV[MAIL_PORT]");

}

$config = [
    'userClass' => \app\models\User::class,
    'db' => [
        'dsn' => getenv('DB_DSN'),
        'user' => getenv('DB_USER'),
        'password' => getenv('DB_PASSWORD')
    ],
    'mail' => [
        'host' => getenv('MAIL_HOST'),
        'username' => getenv('MAIL_USERNAME'),
        'password' => getenv('MAIL_PASSWORD'),
        'port' => getenv('MAIL_PORT'),
    ]
];


$app = new Application(dirname(__DIR__), $config);
$app->router->get('/',[SiteController::class,'home']);
$app->router->get('/about',[SiteController::class,'about']);
$app->router->get('/contact',[SiteController::class,'contact']);
$app->router->post('/contact',[SiteController::class,'contact']);
$app->router->get('/admin',[SiteController::class,'dashboard']);
$app->router->get('/comment',[SiteController::class,'comment']);
$app->router->post('/comment',[SiteController::class,'comment']);
$app->router->get('/reserve',[SiteController::class,'reserve']);
$app->router->post('/reserve',[SiteController::class,'reserve']);
$app->router->get('/reservations',[SiteController::class,'reservations']);
$app->router->get('/cart',[SiteController::class,'cart']);
$app->router->post('/cart',[SiteController::class,'cart']);
$app->router->get('/cart-items',[SiteController::class,'cartItems']);
$app->router->post('/cart-items',[SiteController::class,'cartItems']);
$app->router->get('/checkout',[SiteController::class,'checkout']);
$app->router->post('/checkout',[SiteController::class,'checkout']);
$app->router->get('/payment',[SiteController::class,'payment']);
$app->router->post('/payment',[SiteController::class,'payment']);

$app->router->get('/register',[AuthController::class,'register']);
$app->router->post('/register',[AuthController::class,'register']);

$app->router->get('/login',[AuthController::class,'login']);
$app->router->post('/login',[AuthController::class,'login']);
$app->router->get('/password-reset',[AuthController::class, 'resetPasswordRequest']);
$app->router->post('/password-reset',[AuthController::class, 'resetPasswordRequest']);

$app->router->get('/profile',[AuthController::class,'profile']);
$app->router->post('/profile',[AuthController::class,'profile']);
$app->router->get('/logout',[AuthController::class,'logout']);

$app->router->get('/menu',[MenuController::class,'menu']);
$app->router->get('/menuitem',[MenuController::class,'menuitem']);
$app->router->get('/menuitems',[MenuController::class,'menus']);
$app->router->get('/admin_dishes_add',[MenuController::class,'add_menu']);
$app->router->post('/admin_dishes_add',[MenuController::class,'add_menu']);
$app->router->get('/admin_dishes',[MenuController::class,'dishes']);
$app->router->get('/admin_dishes_delete',[MenuController::class,'delete_menu']);
$app->router->get('/admin_dish_edit',[MenuController::class,'edit_menu']);
$app->router->post('/admin_dish_edit',[MenuController::class,'edit_menu']);
$app->router->get('/admin_dish_comments',[MenuController::class,'dish_comments']);
$app->router->get('/item_comments',[MenuController::class,'item_comments']);

$app->router->get('/admin_users',[AuthController::class,'users']);
$app->router->get('/file',[SiteController::class,'getFile']);

$app->run();

