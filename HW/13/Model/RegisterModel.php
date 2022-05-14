<?php

namespace Model;

use Core\Model;

class RegisterModel extends Model
{
    public $firstName='';
    public $lastName='';
    public $email='';
    public $role='';
    public $password='';
    public $confirmPassword='';


    public function register()
    {
        return "yes done!";
    }

    public function rules() : array
    {
        return [
            'firstName' => [self::RULE_REQUIRED],
            'lastName' => [self::RULE_REQUIRED],
            'email' => [self::RULE_REQUIRED ,self::RULE_EMAIL],
            'role' => [self::RULE_REQUIRED],
            'password' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 6], [self::RULE_MAX, 'max' => 20]],
            'confirmPassword' => [self::RULE_REQUIRED, [self::RULE_MATCH, 'match' => 'password']]
        ];
    }

}