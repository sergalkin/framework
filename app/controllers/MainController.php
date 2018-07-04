<?php

namespace app\controllers;

use app\models\Main;
use fw\core\App;
use fw\core\base\View;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use PHPMailer\PHPMailer\PHPMailer;


class MainController extends AppController
{
    public function indexAction()
    {
/*
        $log = new Logger('name');
        $log->pushHandler(new StreamHandler(ROOT . '/tmp/your.log',Logger::WARNING));

        $log->warning('Foo');
        $log->error('Bar');


        $mailer = new PHPMailer();
        var_dump($mailer);*/

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