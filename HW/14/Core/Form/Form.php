<?php

namespace Core\Form;

use Core\Model;

class Form 
{

    public static function begin(string $action, string $method, string $enctype = '')
    {
        echo sprintf('<form class="form" action="%s" method="%s" %s>', $action, $method, $enctype);
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