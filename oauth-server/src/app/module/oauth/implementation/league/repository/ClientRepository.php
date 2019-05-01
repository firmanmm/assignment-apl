<?php

namespace App\Oauth\Implementation\League\Repository;

use Phalcon\Db\Column;
use App\Oauth\Base\Provider;
use App\Oauth\Implementation\League\Entity\ClientEntity;
use League\OAuth2\Server\Repositories\ClientRepositoryInterface;

class ClientRepository extends Provider implements ClientRepositoryInterface {


    public function getClientEntity($clientIdentifier, $grantType = null, $clientSecret = null, $mustValidateSecret = true) {
        $connection = $this->getConnection();
        $stmt = $connection->prepare("SELECT * FROM oauth_clients WHERE client_id = :id LIMIT 1");
        $result = $connection->executePrepared($stmt,[
            "id" => $clientIdentifier,
        ], [
            "id" => Column::BIND_PARAM_STR
        ]);
        if($result->rowCount() == 0){
            return;
        }
        $client = new ClientEntity();
        $client->fromArray($result->fetchAll()[0]);
        if($mustValidateSecret && !$client->verifyPassword($clientSecret)) {
            die();
            return;
        }
        return $client;
    }
}