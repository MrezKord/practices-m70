<?php

namespace Model;

use Core\Model;
use Core\dbModel;

class UserRegister extends dbModel
{



    public $firstName='';
    public $lastName='';
    public $email='';
    public $role='';
    public $password='';
    public $confirmPassword='';
    public $status = '';


    public function save()
    {
        $this->status = self::INACTIVE;
        if (!$this->find(['role' => 'Boss']) && $this->role = 'Boss') {
            $this->status = self::ACTIVE;
        }
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        return parent::save();
    }

    public function rules() : array
    {
        return [
            'firstName' => [self::RULE_REQUIRED],
            'lastName' => [self::RULE_REQUIRED],
            'email' => [self::RULE_REQUIRED ,self::RULE_EMAIL, [self::RULE_UNIQUE, 'class' => self::class]],
            'role' => [self::RULE_REQUIRED],
            'password' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 6], [self::RULE_MAX, 'max' => 20]],
            'confirmPassword' => [self::RULE_REQUIRED, [self::RULE_MATCH, 'match' => 'password']]
        ];
    }

    public function tableName() : string
    {
        return 'users';
    }

    public function attributes() : array
    {
        return ['firstName', 'lastName', 'role', 'email', 'status', 'password'];
    }

    public function label(): array
    {
        return [
            'firstName' => 'First Name',
            'lastName' => 'Last Name',
            'email' => 'Email',
            'role' => 'Role',
            'password' => 'Password',
            'confirmPassword' => 'Confirm Password'
        ];
    }

}