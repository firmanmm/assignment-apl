<?php

namespace App\Oauth\Implementation\League\Entity;

use League\OAuth2\Server\Entities\ClientEntityInterface;
use League\OAuth2\Server\Entities\Traits\ClientTrait;
use League\OAuth2\Server\Entities\Traits\EntityTrait;
use App\Oauth\Base\DataInterface;

class ClientEntity implements ClientEntityInterface, DataInterface
{
    use EntityTrait, ClientTrait;

    protected $password;

    public function setName($name)
    {
        $this->name = $name;
    }
    public function setRedirectUri($uri)
    {
        $this->redirectUri = $uri;
    }

    public function verifyPassword($password) {
        return password_verify($password, $this->password);
    }

    public function fromArray($array) {
        $this->setIdentifier($array["client_id"]);
        $this->setName($array["client_id"]);
        $this->setRedirectUri($array["redirect_uri"]);
        $this->password = $array['client_secret'];
    }

    
}