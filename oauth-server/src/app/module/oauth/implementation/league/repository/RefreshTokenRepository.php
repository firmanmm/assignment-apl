<?php

namespace App\Oauth\Implementation\League\Repository;

use League\OAuth2\Server\Entities\RefreshTokenEntityInterface;
use League\OAuth2\Server\Repositories\RefreshTokenRepositoryInterface;
use App\Oauth\Base\Provider;
use App\Oauth\Implementation\League\Entity\RefreshTokenEntity;

class RefreshTokenRepository extends Provider implements RefreshTokenRepositoryInterface {


    public function getNewRefreshToken(){
        return new RefreshTokenEntity();
    }
    public function persistNewRefreshToken(RefreshTokenEntityInterface $refreshTokenEntity){
        $_SESSION["refresh_token"] = $refreshTokenEntity; //TODO : Replace with actual DB :/
    }
    public function revokeRefreshToken($tokenId){
        $_SESSION["refresh_token"] = null; //TODO : Replace with actual DB Removal
    }
    public function isRefreshTokenRevoked($tokenId){
        return false;
    }
}