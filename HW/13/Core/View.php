<?php

namespace Core;

class View
{

    private $pathView;
    private $layout = "Main";

    public function __construct()
    {
        $this->pathView = dirname(__DIR__) . '\\view\\';
    }

    public function setLayout(string $layout)
    {
        $this->layout = $layout;
    }

    public function show(string $path, array $data = [])
    {

        $main = $this->showOnly('layout\\'.$this->layout.'.php');
        $subject = $this->showOnly($path, $data);
        
        echo str_replace('{{contents}}', $subject, $main);
    }

    public function showOnly(string $path, $data = [])
    {
        extract($data);
        ob_start();
        require_once $this->pathView . $path;
        $subject = ob_get_contents();
        ob_clean();
        return $subject;
    }
}
