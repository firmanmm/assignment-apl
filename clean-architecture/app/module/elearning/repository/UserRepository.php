<?php

namespace App\Elearning\Repository;

use App\Elearning\Repository\Repository;
use Domain\Elearning\Repository\UserRepositoryInterface;
use Domain\Elearning\Entity\UserEntity;
use Phalcon\Db\Column;

class UserRepository extends Repository implements UserRepositoryInterface {

    public function getAll() : array{
        $conn = $this->getConnection();
        $stmt = $conn->prepare("SELECT * FROM users");
        $result = $conn->executePrepared($stmt,[],[]);
        
        $rawUsers = $result->fetchAll();
        $users = [];
        foreach($rawUsers as $rawUser) {
            $users[] = $this->makeUser($rawUser);
        } 
        return $users;
    }

    public function getById(int $id) : ?UserEntity {
        $conn = $this->getConnection();
        $stmt = $conn->prepare("SELECT * FROM users WHERE id = :id LIMIT 1");
        $result = $conn->executePrepared($stmt,[
            'id' => $id,
        ],[
            'id' => Column::BIND_PARAM_INT
        ]);
        $rawUsers = $result->fetchAll();
        return (isset($rawUsers[0])) ? $this->makeUser($rawUsers[0]) : null;
    }

    private function makeUser(array $raw) : UserEntity {
        $tempUser = new UserEntity();
        $this->populateAbstract($tempUser, $raw);
        $tempUser->setName($raw['name']);
        $tempUser->setPassword($raw['password']);
        $tempUser->setStudentId($raw['student_id']);
        return $tempUser;
    }

    public function insert($data) : UserEntity{
        $conn = $this->getConnection();
        $stmt = $conn->prepare("INSERT INTO users(`name`, `student_id`, `password`) VALUES (:name, :studentId, :password)");
        $result = $conn->executePrepared($stmt,[
            'name' => $data->getName(),
            'studentId' => $data->getStudentId(),
            'password' => $data->getPassword()
        ],[
            'name' => Column::BIND_PARAM_STR,
            'studentId' => Column::BIND_PARAM_STR,
            'password' => Column::BIND_PARAM_STR
        ]);
        $data->setId($conn->lastInsertId());
        return $data;
    }

    public function update(UserEntity $data): UserEntity
    {
        $conn = $this->getConnection();
        $stmt = $conn->prepare("UPDATE users SET name=:name, student_id=:studentId, password=:password WHERE id = :id");
        $result = $conn->executePrepared($stmt,[
            'id' => $data->getId(),
            'name' => $data->getName(),
            'studentId' => $data->getStudentId(),
            'password' => $data->getPassword()
        ],[
            'id' => Column::BIND_PARAM_INT,
            'name' => Column::BIND_PARAM_STR,
            'studentId' => Column::BIND_PARAM_STR,
            'password' => Column::BIND_PARAM_STR
        ]);
        $data->setId($conn->lastInsertId());
        return $data;
    }

    public function delete(int $id) : void {
        $conn = $this->getConnection();
        $stmt = $conn->prepare("UPDATE `users` SET deleted_at = NOW() WHERE id = :id AND deleted_at IS NULL");
        $result = $conn->executePrepared($stmt,[
            'id' => $id
        ],[
            'id' => Column::BIND_PARAM_INT
        ]);
    }

    function getByStudentId(String $studentId) : UserEntity {
        $conn = $this->getConnection();
        $stmt = $conn->prepare("SELECT * FROM users WHERE student_id = :studentId LIMIT 1");
        $result = $conn->executePrepared($stmt,[
            'studentId' => $studentId,
        ],[
            'studentId' => Column::BIND_PARAM_STR
        ]);
        $rawUsers = $result->fetchAll();
        $rawUser = (isset($rawUsers[0])) ? $rawUsers[0] : null;
        if ($rawUser != null){
            return $this->makeUser($rawUser);
        } 
        return null;
    }
}