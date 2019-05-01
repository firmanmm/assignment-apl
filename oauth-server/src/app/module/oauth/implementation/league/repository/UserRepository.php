<?php
namespace App\Oauth\Implementation\League\Repository;

use Phalcon\Db\Column;

use League\OAuth2\Server\Entities\ClientEntityInterface;
use League\OAuth2\Server\Repositories\UserRepositoryInterface;
use App\Oauth\Base\Provider;
use App\Oauth\Implementation\League\Entity\UserEntity;

class UserRepository extends Provider implements UserRepositoryInterface {



    public function getUserEntityByUserCredentials(
        $username,
        $password,
        $grantType,
        ClientEntityInterface $clientEntity
    ) {
        $conn = $this->getConnection();
        $stmt = $conn->prepare("SELECT * FROM oauth_users WHERE username = :username: LIMIT 1");
        $result = $conn->executePrepared($stmt, [
            "username" => $username,
        ], [
            "username" => Column::BIND_PARAM_STR
        ]);
        if($result->rowCount() == 0){
            return;
        }
        $user = new UserEntity();
        $user->fromArray($result->fetchAll()[0]);
        if(!$user->verifyPassword($password)) {
            return;
        }
        return $user;
    }
}