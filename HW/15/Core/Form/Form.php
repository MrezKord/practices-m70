<?php

namespace Core\Form;

use Core\Model;

class Form 
{

    public static function begin(string $action, string $method, string $enctype = '', string $class = '')
    {
        echo sprintf('<form class="%s" action="%s" method="%s" %s>', $class, $action, $method, $enctype);
        return new Form;
    }

    public static function end()
    {
        echo '</form>';
    }

    public function field(Model $model, $attribute)
    {
        return new Field($model, $attribute);
    }
}