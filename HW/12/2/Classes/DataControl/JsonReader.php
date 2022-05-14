<?php

namespace DataControl;

class JsonReader implements DataInterface{
    private $data;
    private $path;


    /**
     * Constructor
     * 
     * @param string $path
     */

    public function __construct(){}

    public function path(string $path)
    {
        $this->path = $path;
        return $this;
    }

    public function create(string $path)
    {
        if (!file_exists($path)) {
            $open = fopen($path, 'a');
            fclose($open);
        }
    }

    public function Exist($target, $col_name)
    {
        $container = $this->exportToArray();
        $result = (!is_null($container)) ? array_map(fn ($val) => $val[$col_name], $container) : [] ;
        return in_array($target, $result) ? true : false;
    }
    
    /**
     * insert vehicle to json file
     * 
     * @return array
     */

    public function insert(array $subject)
    {
        $container = $this->exportToArray();
        $container[] = $subject;
        $this->write($container);
    }

    public function update(array $subject, $key, $value)
    {
        $container = $this->exportToArray();
        $filter = array_filter($container, fn($val) => $val[$key] === $value);
        foreach ($filter as $key => &$value) {
            $value = array_replace($value, $subject);
        }
        $container = array_replace($container, $filter);
        $this->write($container);
    }

    public function delete($key, $value)
    {
        $container = $this->exportToArray();
        $filter = array_filter($container, fn ($val) => $val[$key] === $value);
        foreach ($filter as $key => $value) {
            unset($container[$key]);
        }
        $this->write($container);
    }

    /**
     * Write in json file
     * 
     * @param array $target
     */

    private function write(array $target){ 
        file_put_contents($this->path, json_encode($target, JSON_PRETTY_PRINT));
    }

    /**
     * Decode data and export to array
     * 
     * @return array
     */

    public function exportToArray(){
        $container = file_get_contents($this->path);
        $this->data = json_decode($container, true);
        $this->data ?? [];
        return $this->data;
    }
}



