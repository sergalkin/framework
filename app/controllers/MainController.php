<?php

namespace app\controllers;

use app\models\Main, vendor\core\App;
use vendor\core\base\View;


class MainController extends AppController
{
    public function indexAction()
    {
        $model = new Main;
        $posts = \R::findAll('posts');

        $menu = $this->menu;
        $title = 'PAGE TITLE';
        View::setMeta('Главная страница', 'Описание страницы', 'Ключевые слова');
        $this->set(compact('title', 'posts', 'menu'));
    }

    public function testAction()
    {
        if ($this->isAjax()) {
            $model = new Main();
            $post = \R::findOne('posts', "id = {$_POST['id']}");
            $this->loadView('_test', compact('post'));
            die;
        }
        echo 222;

    }

}