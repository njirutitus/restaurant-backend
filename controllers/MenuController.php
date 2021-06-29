<?php


namespace app\controllers;


use app\models\ContactForm;
use app\models\Menu;
use tn\phpmvc\Application;
use tn\phpmvc\Controller;
use tn\phpmvc\Request;
use tn\phpmvc\Response;

class MenuController extends Controller
{
    /**
     * Undocumented function
     */
    public function menu()
    {
        return $this->render('menu');
    }

    public function add_menu(Request $request, Response $response)
    {
        $this->setLayout('admin');
        $menu = new Menu();
        if($request->isPost()){
            $menu->loadData($request->getBody());
            if($menu->validate() && $menu->add()) {
                    Application::$app->session->setFlash('success','Menu Item added successfully');
            }
            else {
                Application::$app->session->setFlash('error','Sorry! An error occurred.');
            }
            $response->redirect('/contact');
            exit();
        }
        return $this->render('dish',[
            'model' => $menu
        ]);
    }
    public function menuitem()
    {
        return $this->render('menu_view');
    }
    
    public function menus(){
        $menuitems[0] = array("id"=>1,"title"=>"Mashed potatoes","desc"=>"First food to be grow on the moon","price"=>3000,"img"=>"./images/item-1.jpeg","category"=>"breakfast");
        return json_encode($menuitems);
    }

}