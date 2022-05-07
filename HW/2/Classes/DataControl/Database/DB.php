<?php

namespace DataControl\Database;

use DataControl\DataInterface;

class DB implements DataInterface
{

    private string $table;
    private $query;
    private $pdo;

    public function __construct()
    {
        $this->pdo = Connection::getInstance()->getConnection();
    }

    public function create(string $query)
    {
        $this->pdo->query($query);
    }

    public function path(string $table)
    {
        $this->table = $table;
        return $this;
    }

    public function exportToArray()
    {
        $this->query = 'SELECT * FROM ' . $this->table;
        $stmt = $this->pdo->prepare($this->query);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function Exist($target, $col_name)
    {
        try {
            $this->query = "SELECT `$col_name` FROM `$this->table`";
            $result = $this->pdo->query($this->query)->fetchAll();
            return in_array([$col_name => $target], $result);
        } catch (\Exception $th) {
            echo $th->getMessage();            
        }
    }

    public function insert(array $fields)
    {
        $keys = implode(', ', array_keys($fields));
        $values = array_values($fields);
        $values =  array_map(fn ($val) => "'$val'", $values);
        $values = implode(', ', $values);
        $this->query = "INSERT INTO {$this->table} ($keys) VALUES ($values)";
        $this->execute($this->query);
        return $this;
    }

    public function update(array $fields, $key, $value)
    {
        $fields = array_map(fn ($val) => array_search($val, $fields) . ' = ' . "'$val'", $fields);
        $fields = implode(', ', $fields);
        $this->query .= "UPDATE $this->table SET $fields WHERE $key = $value";
        $this->execute($this->query);
        return $this;
    }

    public function delete($key, $value, $reset = null)
    {
        $this->query = "DELETE FROM `$this->table` WHERE $key = '$value'";
        $this->execute($this->query);
        if ($reset !== null) {
            $this->reset();
        }
        return $this;
    }

    private function execute(string $query)
    {
        $this->pdo->exec($query);
    }

    private function reset($col_name = 'id')
    {
        $this->query = "SET  @num := 0; UPDATE $this->table SET `$col_name` = @num := (@num+1); ALTER TABLE $this->table AUTO_INCREMENT =1;";
        $this->execute($this->query);
    }
}
