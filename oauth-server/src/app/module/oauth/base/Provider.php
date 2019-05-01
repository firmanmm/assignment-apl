<?php

namespace App\Oauth\Base;

use Phalcon\Db\Adapter\Pdo\Mysql;
use Phalcon\Di;
use Phalcon\DiInterface;

class Provider {

    /** @var Phalcon\Db\Adapter Database connection from DI */
    private $db;

    public function __construct($di) {
        $this->db = $di['database'];
    }

   
    /**
     * @return Mysql MySQLConnection
     */
    protected function getConnection() {
        return $this->db;
    }
}