<?php

namespace vendor\core;


class DB
{
    /**
     * @var \PDO
     */
    protected $pdo;
    /**
     * @var
     */
    protected static $instance;

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
        $options = [
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
        ];
        $this->pdo = new \PDO($db['dsn'], $db['user'], $db['pass'], $options);
    }

    /**
     * @return DB
     */
    public static function instance()
    {
        if (self::$instance === null) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    /**
     * @param $sql
     * @return bool
     */
    public function execute($sql, $params = [])
    {
        self::$countSql++;
        self::$queries[] = $sql;
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($params);
    }

    /**
     * @param $sql
     * @return array
     */
    public function query($sql, $params = [])
    {
        self::$countSql++;
        self::$queries[] = $sql;
        $stmt = $this->pdo->prepare($sql);
        $res = $stmt->execute($params);
        if ($res !== false) {
            return $stmt->fetchAll();
        }
        return [];
    }
}