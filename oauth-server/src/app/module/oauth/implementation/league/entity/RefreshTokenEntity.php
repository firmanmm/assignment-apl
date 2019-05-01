<?php

namespace App\Oauth\Implementation\League\Entity;

use League\OAuth2\Server\Entities\RefreshTokenEntityInterface;
use League\OAuth2\Server\Entities\Traits\EntityTrait;
use League\OAuth2\Server\Entities\Traits\RefreshTokenTrait;
use App\Oauth\Base\DataInterface;

class RefreshTokenEntity implements RefreshTokenEntityInterface, DataInterface
{
    use RefreshTokenTrait, EntityTrait;

    public function fromArray($array) {
        //TODO Implements
    }
}