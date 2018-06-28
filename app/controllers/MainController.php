<?php

namespace app\controllers;

use app\models\Main, vendor\core\App;


class MainController extends AppController
{
    public function indexAction()
    {
        $model = new Main;

        $posts = \R::findAll('posts');

        $menu = $this->menu;
        $title = 'PAGE TITLE';
        $this->setMeta('Главная страница', 'Описание страницы', 'Ключевые слова');
        $meta = $this->meta;
        $this->set(compact('title', 'posts', 'menu', 'meta'));
    }

    public function testAction()
    {
        if ($this->isAjax()) {
            $model = new Main();
            $post = \R::findOne('posts', "id = {$_POST['id']}");
            debug($post);
            die;
        }
        echo 222;

    }

}