<?php

namespace Core;

use finfo;
use Model\User;
use PDO;

abstract class dbModel extends Model
{

    public const ACTIVE = 1;
    public const INACTIVE = 0;

    public function __construct()
    {
    }

    abstract public function tableName(): string;
    abstract public function attributes(): array;
    abstract public function label() : array;


    public function properties()
    {
        $params = [];
        foreach ($this->attributes() as $value) {
            $params[$value] = $this->$value;
        }
        return $params;
    }

    public function save()
    {
        Application::$app->getInstanceOfClasses('medoo')
            ->insert($this->tableName(), $this->properties());
        return true;
    }

    public function find(array $where)
    {
        $query = Application::$app->getInstanceOfClasses('medoo')
            ->get($this->tableName(), '*', $where);
        return $query;
    }

    public function update(array $field, array $where)
    {
        $query = Application::$app->getInstanceOfClasses('medoo')
                                  ->update($this->tableName(), $field, $where);
        return $query;
    }

    public function get($col, $where = [])
    {
        $result = Application::$app->getInstanceOfClasses('medoo')
                                   ->select($this->tableName(), $col, $where);
        return $result;
    }

    public function join(array $join, string|array $select, array $where = [])
    {
        $result = Application::$app->getInstanceOfClasses('medoo')
                                   ->select($this->tableName(), $join, $select, $where);
        return $result;
    }

    public function delete(array $where)
    {
        $result = Application::$app->getInstanceOfClasses('medoo')
                                   ->delete($this->tableName(), $where);
        return $result;
    }

    
    public function setAllAttribute($set)
    {
        foreach ($this->attributes() as $key => $value) {
            $this->$value = $set;
        }
    }
}
