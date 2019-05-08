<?php

namespace App\Elearning\Repository;

use Phalcon\Db\Adapter\Pdo\Mysql;
use Phalcon\Di;
use Phalcon\DiInterface;

abstract class Repository {

    /** @var Mysql Database connection from DI */
    private $db;

    public function __construct($di) {
        $this->db = $di['database'];
    }

    
    /**
     * @return Mysql MySQLConnection
     */
    protected function getConnection() : Mysql{
        return $this->db;
    }
}