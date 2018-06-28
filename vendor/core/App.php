<?php


namespace vendor\core;

use vendor\core\Registry;

class App
{
    public static $app;

    /**
     * App constructor.
     */
    public function __construct()
    {
        self::$app = Registry::instance();
    }


}