<?php

namespace App\Oauth\Implementation\League\Repository;

use Phalcon\Db\Column;
use League\OAuth2\Server\Entities\ClientEntityInterface;
use League\OAuth2\Server\Repositories\ScopeRepositoryInterface;
use App\Oauth\Base\Provider;
use App\Oauth\Implementation\League\Entity\ScopeEntitiy;

class ScopeRepository extends Provider implements ScopeRepositoryInterface {



    public function getScopeEntityByIdentifier($identifier){
        $conn = $this->getConnection();
        $stmt = $conn->prepare("SELECT * FROM scopes WHERE id = :id: LIMIT 1");
        $result = $conn->executePrepared($stmt, [
            "id" => $identifier
        ], [
            "id" => Column::BIND_PARAM_STR
        ]);
        if($result->rowCount() == 0) {
            return;
        }
        $scope = new ScopeEntitiy();
        $scope->fromArray($result->fetchAll()[0]);
        return $scope;
    }

    public function finalizeScopes(
        array $scopes,
        $grantType,
        ClientEntityInterface $clientEntity,
        $userIdentifier = null
    ) {
        return $scopes;
    }
}