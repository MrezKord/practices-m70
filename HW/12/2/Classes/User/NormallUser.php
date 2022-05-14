<?php

namespace User;

class NormallUser implements User 
{
    public function __construct(private string $user, private string $email, private  $password){}

    public function getUser() : array
    {
        return [
            'Username' => $this->user,
            'Email' => $this->email,
            'Password' => $this->password
        ];
    }

    public function getName()
    {
        return $this->user;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPassword()
    {
        return $this->password;
    }
}