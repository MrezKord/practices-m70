<?php

namespace Authenticate;


use DataControl\DataInterface;
use User\User;

class Auth
{

    private Validation $validation;

    public function __construct(private DataInterface $db)
    {
        $this->validation = Validation::getInstance();
    }


    public function register(User $user)
    {
        if (
            $this->validation->Validation($user->getName(), ['username']) &&
            $this->validation->Validation($user->getEmail(), ['email']) &&
            !$this->db->Exist($user->getName(), 'Username')
        ) {

            $this->db->insert($user->getUser());
            echo "Registering Successfuly";
        } else {
            echo 'error';
        }
    }

    public function login($username, $password)
    {
        if ($this->db->Exist($username, 'Username')) {
            $container = $this->db->exportToArray();
            $result = array_filter($container, fn ($val) => $val['Username'] === $username);
            if (array_values($result)[0]['Password'] == $password) {
                echo "you are login";
            }
        }
    }
}
