<?php

namespace App\Oauth\Implementation\League\Entity;

use League\OAuth2\Server\Entities\UserEntityInterface;
use League\OAuth2\Server\Entities\Traits\EntityTrait;
use App\Oauth\Base\DataInterface;

class UserEntity implements UserEntityInterface, DataInterface
{
    use EntityTrait;
    
    private $username;
    private $password;

    public function getUsername() {
        return $this->username;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setUsername($username) {
        $this->username = $username;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function verifyPassword($password) {
        return password_verify($password, $this->password);
    }

    public function fromArray($array) {
        //TODO Implements
    }
}