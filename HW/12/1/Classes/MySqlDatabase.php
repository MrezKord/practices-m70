<?php

class MySqlDatabase implements DatabaseInterface
{
    private $connection;
    private $table;
    private $stmt;
    
    public function __construct(DatabaseConnectionInterface $connection)
    {
        $this->connection = $connection;
    }

    public function setStatment(string $stmt) : DatabaseInterface
    {
        $this->stmt .= $stmt;
        return $this;
    }

    public function table(string $table): DatabaseInterface
    {
        $this->table="`$table`";
        return $this;
    }

    public function select(array $cols = ['*']): DatabaseInterface
    {
        $cols_str = implode(',', $cols);
        $this->stmt = 'SELECT '.$cols_str.' FROM '.$this->table;
        return $this;
    }

    public function insert(array $fields): DatabaseInterface
    {
        $keys = implode(', ' ,array_keys($fields));
        $values = array_values($fields);
        $values =  array_map(fn ($val) => "'$val'", $values);
        $values = implode(', ' ,$values);
        $this->stmt= "INSERT INTO {$this->table} ($keys) VALUES ($values)";
        return $this;
    }

    public function update(array $fields): DatabaseInterface
    {
        $fields = array_map(fn ($val) => array_search($val, $fields). ' = ' . "'$val'", $fields);
        $fields = implode(', ', $fields);
        $this->stmt .= "UPDATE $this->table SET $fields";
        return $this;
    }

    public function condition(string $val1, string $val2, string $operation = '=', string $model = 'WHERE'): DatabaseInterface
    {
        if ($model === 'WHERE') {
            $this->stmt .= " WHERE $val1 $operation '$val2'";
        }elseif($model === 'HAVING') {
            $this->stmt .= " HAVING $val1 $operation '$val2'";
        }
        return $this;
    }

    public function join(string $secondTable, string $val1, string $val2,  $model = "INNER") : DatabaseInterface
    {
        $secondTable = "`$secondTable`";
        $this->stmt .= " $model JOIN $secondTable ON $this->table.$val1 = $secondTable.$val2";
        return $this;
    }


    public function groupBy(string $col) : DatabaseInterface
    {
        $this->stmt .= " GROUP BY $col";
        return $this;
    }

    public function fetch()
    {
        $this->execute();
        $result = $this->stmt->fetch();
        return $result;    
    }

    public function fetchAll()
    {
        $this->execute();
        $result = $this->stmt->fetchAll();
        return $result;
    }

    public function execute()
    {
        $this->stmt = $this->connection->getPDO()->prepare($this->stmt);
        $this->stmt->execute();
    }

    public function exec(): bool
    {       
        return $this->connection->getPDO()->exec($this->stmt);
    }
}
