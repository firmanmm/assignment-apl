<?php
namespace App\Oauth\Implementation\League\Repository;

use League\OAuth2\Server\Entities\AuthCodeEntityInterface;
use League\OAuth2\Server\Repositories\AuthCodeRepositoryInterface;
use App\Oauth\Base\Provider;
use App\Oauth\Implementation\League\Entity\AuthCodeEntity;

class AuthCodeRepository extends Provider implements AuthCodeRepositoryInterface {


    public function getNewAuthCode() {
        return new AuthCodeEntity();
    }
    public function persistNewAuthCode(AuthCodeEntityInterface $authCodeEntity) {
        //TODO : Logic
    }
    public function revokeAuthCode($codeId) {
        //TODO : Logic
    }
    public function isAuthCodeRevoked($codeId) {
        return false;
    }
}