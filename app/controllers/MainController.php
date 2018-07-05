<?php

namespace app\controllers;

use app\models\Main;
use fw\core\App;
use fw\core\base\View;
use fw\libs\Pagination;


class MainController extends AppController
{
    public function indexAction()
    {
        $model = new Main;

        $total = \R::count('posts');
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $perPage = 2;
        $pagination = new Pagination($page, $perPage, $total);
        $start = $pagination->getStart();

        $posts = \R::findAll('posts', "LIMIT $start, $perPage");

        View::setMeta('Blog :: Главная страница', 'Описание страницы', 'Ключевые слова');
        $this->set(compact('title', 'posts', 'pagination', 'total'));
    }

    public function testAjaxAction()
    {
        if ($this->isAjax()) {
            $model = new Main();
            $post = \R::findOne('posts', "id = {$_POST['id']}");
            $this->loadView('testAjax', compact('post'));
            die;
        }
    }

    public function oldIndexAction()
    {
        $this->layout = 'default';
        $model = new Main;

        $total = \R::count('posts');
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $perPage = 1;
        $pagination = new Pagination($page, $perPage, $total);
        $start = $pagination->getStart();

        $posts = \R::findAll('posts', "LIMIT $start, $perPage");
        $menu = $this->menu;
        $title = 'PAGE TITLE';
        View::setMeta('Главная страница', 'Описание страницы', 'Ключевые слова');
        $this->set(compact('title', 'posts', 'menu', 'pagination', 'total'));
    }

}