<?php

namespace fw\core\base;

use fw\core\DB;
use Valitron\Validator;

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

    public $attributes = [];
    public $errors = [];
    public $rules = [];

    /**
     * Model constructor.
     */
    public function __construct()
    {
        $this->pdo = DB::instance();
    }


    public function load($data)
    {
        foreach ($this->attributes as $name => $value) {
            if (isset($data[$name])) {
                $this->attributes[$name] = $data[$name];
            }
        }
    }

    public function save($table)
    {
        $tbl = \R::dispense($table);
        foreach ($this->attributes as $name => $value) {
            $tbl->$name = $value;
        }
        return \R::store($tbl);
    }

    public function validate($data)
    {
        Validator::langDir(WWW . '/valitron/lang');
        Validator::lang('ru');
        $validator = new Validator($data);
        $validator->rules($this->rules);
        if ($validator->validate()) {
            return true;
        }
        $this->errors = $validator->errors();
        return false;
    }

    public function getErrors()
    {
        $errors = '<ul>';
        foreach ($this->errors as $error) {
            foreach ($error as $item) {
                $errors .= "<li>$item</li>";
            }
        }
        $errors .= '</ul>';
        $_SESSION['error'] = $errors;
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
    public function findLike($str, $field, $table = ''): array
    {
        $table = $table ?: $this->table;
        $sql = "SELECT * FROM $table WHERE $field LIKE ?";
        return $this->pdo->query($sql, ['%' . $str . '%']);
    }
}