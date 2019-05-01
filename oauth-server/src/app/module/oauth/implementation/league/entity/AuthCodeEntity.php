<?php

namespace App\Oauth\Implementation\League\Entity;

use App\Oauth\Base\DataInterface;
use League\OAuth2\Server\Entities\AuthCodeEntityInterface;
use League\OAuth2\Server\Entities\Traits\AuthCodeTrait;
use League\OAuth2\Server\Entities\Traits\EntityTrait;
use League\OAuth2\Server\Entities\Traits\TokenEntityTrait;

class AuthCodeEntity implements AuthCodeEntityInterface, DataInterface
{
    use EntityTrait, TokenEntityTrait, AuthCodeTrait;

    public function fromArray($array) {
        //TODO Implements
    }
}