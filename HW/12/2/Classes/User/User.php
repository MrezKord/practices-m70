<?php

namespace User;

interface User 
{
    public function __construct(string $user, string $email, string $password);
    public function getUser() : array;
    public function getName();
    public function getEmail();
    public function getPassword();
}