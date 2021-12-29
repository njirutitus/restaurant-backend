<?php


namespace app\controllers;


use app\models\CommentForm;
use app\models\ContactForm;
use app\models\Menu;
use app\models\MenuEditForm;
use app\models\User;
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
    public function menuitem(Request $request, Response $response)
    {
        if ($request->isGet()) {
            $data = $request->getBody();
            if(!array_key_exists('id',$data)) {
                $response->redirect('/menu');
                exit();
            }
            $id = $data['id'];
            $result = Menu::findOne(['id' => $id]);
            $comments = CommentForm::findMany(['menu'=> $id],'date DESC');
            $user = new User();
            $users = $user::findAll();

            if ($result) {
                $results = array();
                $results['menuitem'] = $result;
                $results['users'] = $users;

                foreach ($comments as $comment) {
                    $author = "";
                    foreach ($users as $user) {
                        if ($user->id == $comment->author) {
                            $author = $user->firstname . " " . $user->lastname;
                        }
                    }
                    $comment->author_name = $author;
                }
                $results['comments'] = $comments;
                return $this->render('menu_view', [
                        'menuitem' => $result,
                        'comments' => $comments,
                        'users' => $users
                    ]
                );
            }
            else
                throw new NotFoundException();

        }
        return $this->render('menu_view');
    }

    public function item_comments(Request $request)
    {
        if ($request->isGet()) {
            $data = $request->getBody();
            if(!array_key_exists('id',$data)) {
                return json_encode(false);
            }
            $id = $data['id'];
            $comments = CommentForm::findMany(['menu'=> $id],'date ASC');
            $user = new User();
            $users = $user::findAll();

            if ($comments) {
                foreach ($comments as $comment) {
                    $author = "";
                    foreach ($users as $user) {
                        if ($user->id == $comment->author) {
                            $author = $user->firstname . " " . $user->lastname;
                        }
                    }
                    $comment->author_name = $author;
                }
                return json_encode($comments);
            }
        }
        return json_encode(false);
    }

    /**
     * @throws NotFoundException
     */


    public function dish_comments(Request $request, Response $response)
    {
        $this->setLayout('admin');
        if ($request->isGet()) {
            $data = $request->getBody();
            if (!array_key_exists('id', $data)) {
                $response->redirect('/admin_dishes');
                exit();
            }
            $id = $data['id'];
            $result = Menu::findOne(['id' => $id]);
            $comments = CommentForm::findMany(['menu' => $id], 'date DESC');
            $user = new User();
            $users = $user::findAll();

            if ($result){
                return $this->render('comments', [
                        'menuitem' => $result,
                        'comments' => $comments,
                        'users' => $users
                    ]
                );
            }
            else
                throw new NotFoundException();

        }
        return $this->render('comments');
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

    public function delete_menu(Request $request): bool|string
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