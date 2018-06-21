<?php

namespace vendor\core\base;

use vendor\core\DB;

abstract class Model
{
    /**
     * @var DB
     */
    protected $pdo;

    /**
     * @var
     */
    protected $table;

    /**
     * @var string
     */
    protected $pk = 'id';

    /**
     * Model constructor.
     */
    public function __construct()
    {
        $this->pdo = DB::instance();
    }

    /**
     * @param $sql
     * @return bool
     */
    public function query($sql)
    {
        return $this->pdo->execute($sql);
    }

    /**
     * @return array
     */
    public function findAll()
    {
        $sql = "SELECT * FROM {$this->table}";
        return $this->pdo->query($sql);
    }

    /**
     * @param $id
     * @param string $field
     * @return array
     */
    public function findOne($id, $field = '')
    {
        $field = $field ?: $this->pk;
        $sql = "SELECT * FROM {$this->table} WHERE $field = ? LIMIT 1";
        return $this->pdo->query($sql, [$id]);
    }

    /**
     * @param $sql
     * @param array $params
     * @return array
     */
    public function findBySql($sql, $params = [])
    {
        return $this->pdo->query($sql, $params);
    }

    /**
     * @param $str
     * @param $field
     * @param string $table
     * @return array
     */
    public function findLike($str, $field, $table = '')
    {
        $table = $table ?: $this->table;
        $sql = "SELECT * FROM $table WHERE $field LIKE ?";
        return $this->pdo->query($sql, ['%' . $str . '%']);
    }
}