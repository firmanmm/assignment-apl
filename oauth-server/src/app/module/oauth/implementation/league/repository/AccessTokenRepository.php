<?php

namespace App\Oauth\Implementation\League\Repository;

use Phalcon\Db\Column;
use Phalcon\DiInterface;

use League\OAuth2\Server\Entities\AccessTokenEntityInterface;
use League\OAuth2\Server\Entities\ClientEntityInterface;
use League\OAuth2\Server\Repositories\AccessTokenRepositoryInterface;
use App\Oauth\Base\Provider;
use App\Oauth\Implementation\League\Entity\AccessTokenEntity;

class AccessTokenRepository extends Provider implements AccessTokenRepositoryInterface {



    public function getNewToken(ClientEntityInterface $clientEntity, array $scopes, $userIdentifier = null) {
        $accessToken = new AccessTokenEntity();
        $accessToken->setClient($clientEntity);
        foreach ($scopes as $scope) {
            $accessToken->addScope($scope);
        }
        $accessToken->setUserIdentifier($userIdentifier);
        return $accessToken;
    }
    public function persistNewAccessToken(AccessTokenEntityInterface $accessTokenEntity){
        $_SESSION["access_token"] = $accessTokenEntity; //TODO : Replace with actual DB
    }
    public function revokeAccessToken($tokenId){
        $_SESSION["access_token"] = null; //TODO : Replace with actual DB
    }
    public function isAccessTokenRevoked($tokenId){
        return false;
    }
}
