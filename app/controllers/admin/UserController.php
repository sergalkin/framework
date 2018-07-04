<?php

namespace app\controllers\admin;


use vendor\core\base\View;

class UserController extends AppController
{
    public function indexAction()
    {
        View::setMeta('Админка :: Главная страница', 'Описание админки', 'Ключевики админки');
        $test = 'Тестовая переменная';
        $data = ['test', 2];
        $this->set(compact('test', 'data'));
    }

    public function testAction()
    {
        $this->layout = 'default';
        View::setMeta('Админка :: Тестовая страница', 'Описание админки', 'Ключевики админки');
        $test = 'Тестовая переменная';
        $data = ['test', 2];
        $this->set([
            'test' => $test,
            'data' => $data
        ]);
    }
}