<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 04.07.2018
 * Time: 12:18
 */

namespace app\controllers\admin;


class TestController extends AppController
{
    public function indexAction()
    {
        echo __METHOD__;
    }

    public function testAction()
    {
        echo __METHOD__;
    }
}