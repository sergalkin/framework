<?php

namespace app\controllers;


class MainController extends AppController
{
    public function indexAction()
    {
        $name = 'test';
        $this->set(['name' => $name, 'he' => 'lo']);
    }

}