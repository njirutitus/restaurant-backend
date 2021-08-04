<?php


namespace app\controllers;


use app\models\PasswordResetForm;
use app\models\ProfileForm;
use tn\phpmvc\Application;
use tn\phpmvc\Controller;
use tn\phpmvc\middlewares\AdminMiddleware;
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
        $this->registerMiddleWare(new AdminMiddleware(['users']));

    }

    public function login(Request $request, Response $response)
    {
        $this->setLayout('auth');
        $loginForm = new LoginForm();
        if($request->isPost()) {
            $loginForm->loadData($request->getBody());
            if ($loginForm->validate() && $loginForm->login()) {
                if(Application::isStaff() == '1') {
                    $response->redirect('/admin');
                    return;
                }
                $response->redirect('/');
                return;
            }
        }
        return $this->render('login',[
            'model' => $loginForm
        ]);

    }
    public function register(Request $request)
    {
        $this->setLayout('auth');
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
        return $this->render('register',[
            'model'=> $user
        ]);

    }

    public function logout(Request $request, Response $response)
    {
        Application::$app->logout();
        $response->redirect('/');
    }

    public function profile(Request $request)
    {
        $user = new ProfileForm();
        if ($request->isPost()) {
            $user->loadData($request->getBody());

            if($user->validate() && $user->updateProfile()) {
                Application::$app->session->setFlash('success','Your profile has been updated');
                Application::$app->response->redirect('/profile');
                exit();
            }

            return $this->render('profile',[
                'model'=> $user
            ]);
        }
        return $this->render('profile',[
            'model'=> Application::$app->user
        ]);
    }

    public function resetPassword(Request $request)
    {
        $this->setLayout('auth');
        $user = new PasswordResetForm();
        $token = $user->getToken();
        if ($request->isPost()) {
            $user->loadData($request->getBody());
            if(!$user->validate())
            return $this->render('password-reset',[
                'model'=> $user
            ]);
        }
        return $this->render('password-reset',[
            'model'=> $user
        ]);
    }

    public function users()
    {
        $this->setLayout('admin');
        $user = new User();
        $users = $user::findAll();
        return $this->render('users', [
            'users' => $users,
            'model' => $user
        ]);
    }

}