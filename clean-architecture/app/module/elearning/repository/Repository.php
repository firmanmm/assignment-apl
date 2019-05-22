<?php

namespace App\Elearning\Repository;

use Phalcon\Db\Adapter\Pdo\Mysql;
use Phalcon\Di;
use Phalcon\DiInterface;
use Domain\Elearning\Entity\AbstractEntity;

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

    public function populateAbstract(AbstractEntity $entity, $raw) : AbstractEntity {
        $entity->setId($raw["id"]);
        $entity->setCreatedAt(new \DateTime($raw["created_at"]));
        $entity->setDeletedAt(new \DateTime($raw["deleted_at"]));
        return $entity;
    }
}