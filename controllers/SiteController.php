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


use tn\phpmvc\Application;
use tn\phpmvc\Controller;
use tn\phpmvc\Request;
use tn\phpmvc\Response;
use app\models\ContactForm;

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
     * @return void
     */
    public function contact()
    {
        return $this->render('contact');
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
     * @return void
     */
    public function dashboard()
    {
        $this->setLayout('admin');
        return $this->render('admin/dashboard');
    }

}