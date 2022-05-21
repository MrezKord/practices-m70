<?php

namespace Core\File;

use Core\Application;

class FileHandel
{
    
    public static function move(array $file, $name, array $path)
    {
        $path = implode('\\', $path).'\\';
        $extension = pathinfo($file[$name]['name'], PATHINFO_EXTENSION);
        if (!is_dir($path)) {
            mkdir($path);
        }
        $path = $path.self::randomName(10).'.'.$extension;
        move_uploaded_file($file[$name]["tmp_name"], $path);
        return $path;
    }

    public static function randomName($length)
    {
        return substr(md5(time()), 0, $length);
    }
}