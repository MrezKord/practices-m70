<?php

namespace Core;

abstract class Model 
{
    public const RULE_REQUIRED = 'required';
    public const RULE_EMAIL = 'email';
    public const RULE_MIN = 'min';
    public const RULE_MAX = 'max';
    public const RULE_MATCH = 'match';
    public const RULE_UNIQUE = 'unique';
    public const RULE_FILE = 'file'; 

    private array $errors = [];

    public function loadData(array $data)
    {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->{$key} = $value;
            }
        }
    }

    abstract public function rules() : array ;

    public function validate()
    {
        foreach ($this->rules() as $attribute => $ruls) {
            $value = $this->{$attribute};
            foreach ($ruls as $key => $rule) {
                
                $ruleName = $rule;
                if (!is_string($rule)) {
                    $ruleName = $rule[0];
                }

                if (self::RULE_REQUIRED === $ruleName && !$value) {
                    $this->addError($attribute, self::RULE_REQUIRED);
                }
                if (self::RULE_EMAIL === $ruleName && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    $this->addError($attribute, self::RULE_EMAIL);
                }
                if (self::RULE_MIN === $ruleName && strlen($value) < $rule['min']) {
                    $this->addError($attribute, self::RULE_MIN, $rule);
                }
                if (self::RULE_MAX === $ruleName && strlen($value) > $rule['max']) {
                    $this->addError($attribute, self::RULE_MAX, $rule);
                }
                if (self::RULE_MATCH === $ruleName && $value !== $this->{$rule['match']}) {
                    $this->addError($attribute, self::RULE_MATCH, $rule);
                }
                if (self::RULE_UNIQUE === $ruleName) {
                    // $result = Application::$app->getInstanceOfClasses('MySqlDatabase')
                    //                            ->table($rule['class']::tableName())
                    //                            ->select([$attribute])
                    //                            ->condition($attribute, $value)
                    //                            ->fetch();
                    $result = $rule['class']::get([$attribute], [$attribute => $value]);
                    if ($result) {
                        $this->addError($attribute, self::RULE_UNIQUE, ['field' => $attribute]);
                    }
                }
                if (self::RULE_FILE === $ruleName) {
                    if (!$_FILES[$attribute]['name']) {
                        $this->addError($attribute, self::RULE_FILE);
                    }
                }
            }
        }

        return empty($this->errors);
    }

    public function addError(string $attribute, string $rule, array $params = [])
    {
        $message = $this->errorMessage()[$rule] ?? $rule;
        foreach ($params as $key => $value) {
            $message = str_replace("{{$key}}", $value, $message);
        }
        $this->errors[$attribute][] = $message;
    }

    public function getError()
    {
        return $this->errors;
    }
    
    public function errorMessage()
    {
        return [
            self::RULE_REQUIRED => 'This field is required',
            self::RULE_EMAIL => 'This field must be valid email',
            self::RULE_MATCH => 'This field must be the same as {match}',
            self::RULE_MIN => 'Min length of this field must be {min}',
            self::RULE_MAX => 'Max length of this field must be {max}',
            self::RULE_UNIQUE => 'This {field} is alredy exist',
            self::RULE_FILE => 'Please select a file'
        ];
    }

    public function hasError(string $attribute)
    {
        return $this->errors[$attribute] ?? false;
    }

    public function getFirstError(string $attribute)
    {
        return $this->errors[$attribute][0] ?? false;
    }


    
}