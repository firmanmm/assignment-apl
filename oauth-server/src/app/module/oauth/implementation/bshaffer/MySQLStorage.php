<?php

namespace App\Oauth\Implementation\BShaffer;

use OAuth2\Storage\Pdo;

class MySQLStorage extends Pdo {
    protected function checkPassword($user, $password) {
        return password_verify($password, $user['password']);
    }

    protected function hashPassword($password) {
        return password_hash($password, PASSWORD_BCRYPT);
    }

    public function checkClientCredentials($client_id, $client_secret = null) {
        $stmt = $this->db->prepare(sprintf('SELECT * from %s where client_id = :client_id', $this->config['client_table']));
        $stmt->execute(compact('client_id'));
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);

        // make this extensible
        return $result && \password_verify($client_secret, $result['client_secret']);
    }
}