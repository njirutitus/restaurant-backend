<?php
/**
 * PHP version 7.4
 * 
 * @category Controllers
 * @package  Controllers
 * @author   Titus <njirutitus@gmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.html  MIT License
 * @link     http:localhost:8080/ 
 */
namespace app\controllers;


use app\models\CommentForm;
use app\models\Menu;
use app\models\ReservationForm;
use app\models\User;
use tn\phpmvc\Application;
use tn\phpmvc\Controller;
use tn\phpmvc\middlewares\AdminMiddleware;
use tn\phpmvc\middlewares\AuthMiddleware;
use tn\phpmvc\Request;
use tn\phpmvc\Response;
use app\models\ContactForm;
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use tn\phpmvc\utils\Filesystem;

/**
 * Class SiteController
 * 
 * @category Controllers
 * @package  Appmodels
 * @author   Titus <njirutitus@gmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.html  MIT License
 * @link     http:localhost:8080/ 
 */
class SiteController extends Controller
{
    /**
     * SiteController constructor.
     */
    public function __construct()
    {
        $this->registerMiddleWare(new AdminMiddleware(['dashboard','reservations']));
//        $this->registerMiddleWare(new AuthMiddleware(['comment']));
    }

    /**
     * Function home
     *
     * @return array|false|string|string[]
     */
    public function home()
    {
        return $this->render('home');

    }

    public function register()
    {
        $this->setLayout('auth');
        return $this->render('register');

    }

    /**
     * Function about
     *
     * @return mixed
     */
    public function about()
    {
        return $this->render('about');
    }
    /**
     * Function contact
     *
     *
     */
    public function contact(Request $request, Response $response)
    {
        $contact = new ContactForm();
        if($request->isPost()){
            $contact->loadData($request->getBody());
            if($contact->validate() && $contact->add()) {
                if($contact->send()) {
                    Application::$app->session->setFlash('success','Thanks for contacting us');
                }
                else {
                    Application::$app->session->setFlash('error','Sorry! An error occurred.');
                }
                $response->redirect('/contact');
                exit();

            }
        }
        return $this->render('contact',[
            'model' => $contact
        ]);

    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function menu()
    {
        return $this->render('menu');
    }
    /**
     * Function dashboard
     *
     */
    public function dashboard()
    {
        $menu = new Menu();
        $user= new User();
        $comments = new CommentForm();
        $reservation = new ReservationForm();

        $menus = count($menu->fetchAll());
        $users = count($user::findAll());
        $comments = count($comments::findAll());
        $reservations = count($reservation::findAll());


        $this->setLayout('admin');
        return $this->render('dashboard',[
            'users' => $users,
            'menus' => $menus,
            'comments' => $comments,
            'reservations' => $reservations
        ]);
    }

    public function comment(Request $request): bool|string
    {
        $comment = new CommentForm();
        if($request->isPost()){
            $data = $request->getBody();

            $comment->loadData($data);
            if($comment->validate() && $comment->add()) {
               return json_encode(true);
            }
            return json_encode($comment->errors);
        }
        return json_encode(true);
    }

    public function reserve(Request $request): bool|string
    {
        $reservation = new ReservationForm();
        if($request->isPost()){
            $data = $request->getBody();
            $reservation->loadData($data);
            if($reservation->validate() && $reservation->add()) {
                return json_encode(true);
            }
            return json_encode($reservation->errors);
        }
        return json_encode(true);
    }

    public function reservations()
    {
        $this->setLayout('admin');
        $reservation = new ReservationForm();
        $reservations = $reservation->fetchAll();
        return $this->render('reservations', [
            'reservations' => $reservations,
            'model' => $reservation
        ]);
    }

    public function cart(Request $request)
    {
        return $this->render('cart');
    }

    public function cartItems(Request $request)
    {
        $menu = new Menu();
        $items = [];
        if($request->isPost()){
            $data = $request->getBody();
            foreach ($data as $cart) {
               if(gettype($cart) === 'object')
                $cart = json_decode(json_encode($cart), true);
                $item = $menu::findOne(['id'=>$cart['id']]);
                if($item){
                    $item->quantity = $cart['quantity'];
                    array_push($items,$item);
                }
            }
        }
        return json_encode($items);
    }

    public function checkout()
    {
        return $this->render('checkout');
    }

    public function getFile(Request $request)
    {
        $file = new Filesystem();
        $data  = $request->getBody();
        $file->getFile($data['file']);
    }

}