<?php

namespace App\Oauth\Implementation\League\Entity;

use League\OAuth2\Server\Entities\ScopeEntityInterface;
use League\OAuth2\Server\Entities\Traits\EntityTrait;
use League\OAuth2\Server\Entities\Traits\ScopeTrait;
use App\Oauth\Base\DataInterface;

class ScopeEntity implements ScopeEntityInterface, DataInterface
{
    use EntityTrait, ScopeTrait;

    public function fromArray($array) {
        //TODO Implements
    }
}