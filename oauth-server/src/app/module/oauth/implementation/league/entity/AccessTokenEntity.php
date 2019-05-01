<?php

namespace App\Oauth\Implementation\League\Entity;

use League\OAuth2\Server\Entities\AccessTokenEntityInterface;
use League\OAuth2\Server\Entities\Traits\AccessTokenTrait;
use League\OAuth2\Server\Entities\Traits\EntityTrait;
use League\OAuth2\Server\Entities\Traits\TokenEntityTrait;
use App\Oauth\Base\DataInterface;

class AccessTokenEntity implements AccessTokenEntityInterface, DataInterface
{
    use AccessTokenTrait, TokenEntityTrait, EntityTrait;

    public function fromArray($array) {
        //TODO Implements
    }
}