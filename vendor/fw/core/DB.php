<?php

namespace fw\core;

use R;

class DB
{
    use TSingleton;

    /**
     * @var \PDO
     */
    protected $pdo;
    /**
     * @var
     */
    //protected static $instance;

    /**
     * @var int
     */
    public static $countSql = 0;

    /**
     * @var array
     */
    public static $queries = [];

    /**
     * DB constructor.
     */
    protected function __construct()
    {
        $db = require ROOT . '/config/config_db.php';
        require LIBS . '/rb.php';
        R::setup($db['dsn'], $db['user'], $db['pass']);
        R::freeze(true);
    }

    /**
     * @return DB
     */
/*    public static function instance()
    {
        if (self::$instance === null) {
            self::$instance = new self;
        }
        return self::$instance;
    }*/
}