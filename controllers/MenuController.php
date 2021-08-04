<?php


namespace app\controllers;


use app\models\ContactForm;
use app\models\Menu;
use app\models\MenuEditForm;
use tn\phpmvc\Application;
use tn\phpmvc\Controller;
use tn\phpmvc\exception\NotFoundException;
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
        $this->registerMiddleWare(new AdminMiddleware(['add_menu', 'delete_menu','dishes','edit_menu']));

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
        if ($request->isPost()) {
            $data = $request->getBody();
            $menu->loadData($data);

            if ($menu->validate() && $menu->add()) {
                Application::$app->session->setFlash('success', 'Menu Item added successfully');
                $response->redirect('/admin_dishes_add');
                exit();
            }

        }
        return $this->render('dish', [
            'model' => $menu
        ]);
    }

    /**
     * @throws NotFoundException
     */
    public function menuitem(Request $request)
    {
        if ($request->isGet()) {
            $data = $request->getBody();
            $id = $data['id'];
            $result = Menu::findOne(['id' => $id]);
            if ($result)
            return $this->render('menu_view',[
                'menuitem' => $result
                ]
            );
            else
                throw new NotFoundException();

        }
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
        return $this->render('dishes', [
            'dishes' => $dishes,
            'model' => $menu
        ]);

    }

    public function delete_menu(Request $request)
    {
        if ($request->isGet()) {
            $data = $request->getBody();
            $id = $data['id'];
            $result = Menu::deleteOne(['id' => $id]);
//            Application::$app->session->setFlash('success', 'Menu Item deleted successfully');
            return json_encode($result);
        }
        return json_encode(false);
    }

    public function edit_menu(Request $request,Response $response)
    {
        $this->setLayout('admin');
        $menu = new MenuEditForm;

        if ($request->isGet()) {
            $data = $request->getBody();
            $id = $data['id'];
            $menu = MenuEditForm::findOne(['id' => $id]);
            Application::$app->session->set('dish_edit_img',$menu->img) ;
        }

        if ($request->isPost()) {
            $data = $request->getBody();
            $menu->loadData($data);

            if ($menu->validate() && $menu->edit()) {
                if($data['img']['tmp_name'] && Application::$app->session->get('dish_edit_img') &&
                    (Application::$app->session->get('dish_edit_img')) !== $menu->img) {
                    unlink(Application::$app->session->get('dish_edit_img'));
                    Application::$app->session->remove('dish_edit_img');
                }
                Application::$app->session->setFlash('success', 'Menu Item updated successfully');
                $response->redirect('/admin_dishes');
                exit();
            }

        }
        return $this->render('dish_edit', [
            'model' => $menu,
            'img' => Application::$app->session->get('dish_edit_img'),
        ]);
    }

}