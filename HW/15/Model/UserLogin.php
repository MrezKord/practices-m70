<?php

namespace Model;

use Core\dbModel;

class UserLogin extends dbModel
{

    public string $email = '';
    public string $password = '';

    public function rules(): array
    {
        return [
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL],
            'password' => [self::RULE_REQUIRED]
        ];
    }

    public function label() : array
    {
        return [
            'email' => 'Email',
            'password' => 'Password'
        ];
    }

    public function Login()
    {
        $user = $this->find(['email' => $this->email]);
        if (!$user) {
            $this->addError('email', 'User dose not exist with this email address');
            return false;
        }
        if (!password_verify($this->password, $user['password'])) {
            $this->addError('password', 'Incorrect password');
            return false;
        }

        return true;
    }

    public function tableName(): string
    {
        return 'users';
    }

    public function attributes(): array
    {
        return ['email', 'password'];
    }
}
