<?php


namespace app\controllers;


use app\models\PasswordResetForm;
use app\models\ProfileForm;
use app\models\UserToken;
use Cassandra\Date;
use tn\phpmvc\Application;
use tn\phpmvc\Controller;
use tn\phpmvc\middlewares\AdminMiddleware;
use tn\phpmvc\middlewares\AuthMiddleware;
use tn\phpmvc\middlewares\SuperAdminMiddleware;
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
        $this->registerMiddleWare(new SuperAdminMiddleware(['users']));

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
        $user->id = Application::$app->user->id;
        $user->firstname = Application::$app->user->firstname;
        $user->lastname = Application::$app->user->lastname;
        $user->email = Application::$app->user->email;
        $user->password = Application::$app->user->password;
        return $this->render('profile',[
            'model'=> $user
        ]);
    }

    public function resetPasswordRequest(Request $request)
    {
        $this->setLayout('auth');
        $password_reset = new PasswordResetForm();
        $user_token = new UserToken();
        if ($request->isPost()) {
            $password_reset->loadData($request->getBody());
            $token = $password_reset->getToken();
            $url = "http://localhost:8080/password-reset?token=$token";
            if($password_reset->validate()) {
                $user = User::findOne(['email' => $request->getBody()['email']]);
                $primaryKey = $user->primaryKey();
                $primaryValue = $user->{$primaryKey};
                $user_token->user = $primaryValue;
                $user_token->token = $token;
                $user_token->expires_at = date('Y-m-d H:i:s',time()+600);
                $user_token->used = 0;
                $this->setLayout('password-reset-link');

                if($user_token->add() && $password_reset->send($url)) {
                    Application::$app->session->setFlash('success','Password Reset Request successful');
                    Application::$app->response->redirect('/password-reset');
                    exit();
                }
                $this->setLayout('auth');
            }
            return $this->render('password-reset',[
                'model'=> $password_reset
            ]);
        }
        return $this->render('password-reset',[
            'model'=> $password_reset
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