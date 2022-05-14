<?php

namespace DataControl;

interface DataInterface {

    public function path(string $path);
    public function create(string $path);
    public function insert(array $subject);
    public function update(array $subject, $key, $value);
    public function delete($key, $value);
    public function exportToArray();
    public function Exist($target, $col_name);
}