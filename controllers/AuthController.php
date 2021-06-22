<?php


namespace app\controllers;


use tn\phpmvc\Application;
use tn\phpmvc\Controller;
use tn\phpmvc\middlewares\AuthMiddleware;
use tn\phpmvc\Request;
use tn\phpmvc\Response;
use app\models\LoginForm;
use app\models\User;

class AuthController extends Controller
{
    /**
     * AuthController constructor.
     */
    public function __construct()
    {
        $this->registerMiddleWare(new AuthMiddleware(['profile']));
    }

    public function login(Request $request, Response $response)
    {
        $loginForm = new LoginForm();
        if($request->isPost()) {
            $loginForm->loadData($request->getBody());
            if ($loginForm->validate() && $loginForm->login()) {
                $response->redirect('/');
                return;
            }
        }
        $this->setLayout('main');
        return $this->render('login',[
            'model' => $loginForm
        ]);

    }
    public function register(Request $request)
    {
        $user = new User();
        if ($request->isPost()) {
            $user->loadData($request->getBody());

            if($user->validate() && $user->register()) {
                Application::$app->session->setFlash('success','Thank you for registering');
                Application::$app->response->redirect('/');
                exit();
            }

            return $this->render('register',[
                'model'=> $user
            ]);

        }
        $this->setLayout('main');
        return $this->render('register',[
            'model'=> $user
        ]);

    }

    public function logout(Request $request, Response $response)
    {
        Application::$app->logout();
        $response->redirect('/');
    }

    public function profile()
    {
        return $this->render('profile');
    }

}