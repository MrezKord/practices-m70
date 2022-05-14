<?php

namespace Core\Form;

use Core\Model;

class Field
{
    public const TYPE_TEXT = 'text';
    public const TYPE_PASSWORD = 'password';

    private string $type;
    private $showLabel = [
        'firstName' => 'First Name',
        'lastName' => 'Last Name',
        'email' => 'Email',
        'role' => 'Role',
        'password' => 'Password',
        'confirmPassword' => 'Confirm Password'
    ];

    public function __construct(private Model $model, private string $attribute)
    {
        $this->type = self::TYPE_TEXT;
    }


    public function input()
    {
        return sprintf('<div class="mb-6">
                            <label class="%s">%s</label>
                            <input type="%s" name="%s" value="%s" class="field%s">
                            <div class="error-message">%s</div>
                        </div>',
                        $this->model->hasError($this->attribute) ? 'label-field-error' : 'label-field',
                        $this->showLabel[$this->attribute],
                        $this->type,
                        $this->attribute,
                        $this->model->{$this->attribute},
                        $this->model->hasError($this->attribute) ? ' field-error' : '',
                        $this->model->getFirstError($this->attribute));
    }

    public function selectBox(string ...$option)
    {
        $optionTag = "<option value=\"{{value}}\">{{value}}</option>";
        $container = '';
        foreach ($option as $value) {
            $container .= str_replace('{{value}}', $value, $optionTag);
        }

        return sprintf('<div class="mb-6">
                            <label class="%s">%s</label>
                            <select name="%s" class="field%s">
                                <option selected disabled value="">%s</option>
                                %s
                            </select>
                            <div class="error-message">%s</div>
                        </div>',
                        $this->model->hasError($this->attribute) ? 'label-field-error' : 'label-field',
                        $this->showLabel[$this->attribute],
                        $this->attribute,
                        $this->model->hasError($this->attribute) ? ' field-error' : '',
                        $this->attribute,
                        $container,
                        $this->model->getFirstError($this->attribute));
    }

    public function typePassword()
    {
        $this->type = self::TYPE_PASSWORD;
        return $this;
    }
}
