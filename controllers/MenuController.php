<?php


namespace app\controllers;


use app\models\ContactForm;
use app\models\Menu;
use tn\phpmvc\Application;
use tn\phpmvc\Controller;
use tn\phpmvc\middlewares\AdminMiddleware;
use tn\phpmvc\Request;
use tn\phpmvc\Response;
use tn\phpmvc\utils\Filesystem;

class MenuController extends Controller
{
    /**
     * MenuController constructor.
     */
    public function __construct()
    {
        $this->registerMiddleWare(new AdminMiddleware(['add_menu','delete_menu']));

    }

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
        $file = new Filesystem();
        $menu = new Menu();
        if($request->isPost()){
            $data = $request->getBody();
            if ($data['img']['tmp_name']) {
                $file->setMaxSize(10000);
                $file->allowedTypes(array('image/jpeg','image/png','image/gif'));
                $file->setDestFolder('media');
                $img_name = $file->upload($data['img'],array("types" => array('image/jpeg','image/png','image/gif'),"max_size"=>10000,'dest'=>"media"));
            }
            else {
                $img_name = '';
            }
            $data['img'] = $img_name;
            $menu->loadData($data);
            if($menu->validate() && $menu->add()) {
                Application::$app->session->setFlash('success','Menu Item added successfully');
                $response->redirect('/admin_dishes_add');
                exit();
            }

        }
        return $this->render('dish',[
            'model' => $menu
        ]);
    }
    public function menuitem()
    {
        return $this->render('menu_view');
    }
    
    public function menus()
    {
        $menu = new Menu();
        $dishes = $menu->fetchAll();
        return json_encode($dishes);
    }

    public function dishes(): array|bool|string
    {
        $this->setLayout('admin');
        $menu = new Menu();
        $dishes = $menu->fetchAll();
        return $this->render('dishes',[
            'dishes' => $dishes
        ]);

    }

    public function delete_menu(Request $request)
    {
        if($request->isPost()) {
            $data = $request->getBody();
            $id = $data['id'];
            $user = Menu::deleteOne(['id' => $id]);
            return json_encode($user);
        }
    }

}