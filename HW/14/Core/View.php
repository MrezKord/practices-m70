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

    public function show(string|array $path, array $data = [], array $dataLayout = [])
    {
        if ($dataLayout !== []) {
            $main = $this->showOnly('layout\\' . $this->layout . '.php', $dataLayout);
            $subject = $this->showOnly($path, $data);
        }else {
            $main = $this->showOnly('layout\\' . $this->layout . '.php', $data);
            $subject = $this->showOnly($path, $data);
        }

        echo str_replace('{{contents}}', $subject, $main);
    }

    public function showOnly(string|array $path, $data = [])
    {
        if (is_array($path)) {
            $path = $path[0] . '\\' . $path[1];
        }
        extract($data);
        ob_start();
        require_once $this->pathView . $path;
        $subject = ob_get_contents();
        ob_clean();
        return $subject;
    }
}
