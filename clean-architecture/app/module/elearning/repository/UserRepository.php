<?php

namespace App\Elearning\Repository;

use App\Elearning\Repository\Repository;
use Domain\Elearning\Repository\UserRepositoryInterface;
use Domain\Elearning\Entity\UserEntity;
use Phalcon\Db\Column;

class UserRepository extends Repository implements UserRepositoryInterface {

    public function getAll(){
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

    public function getById(int $id) {
        $conn = $this->getConnection();
        $stmt = $conn->prepare("SELECT * FROM users WHERE id = :id ");
        $result = $conn->executePrepared($stmt,[
            'id' => $id,
        ],[
            'id' => Column::BIND_PARAM_INT
        ]);
        $rawUsers = $result->fetchAll();
        $rawUser = (isset($rawUsers[0])) ? $rawUsers[0] : null;
        if ($rawUser != null){
            return $this->makeUser($rawUser);
        } 
        return null;
    }

    private function makeUser(array $raw) : UserEntity {
        $tempUser = new UserEntity((int)$raw['id']);
        $tempUser->setName($raw['name']);
        $tempUser->setStudentId($raw['student_id']);
        return $tempUser;
    }

    /**
     * Save user data to Database
     *
     * @param UserEntity $data
     * @return void
     */
    public function save($data){
        $conn = $this->getConnection();
        $stmt = $conn->prepare("INSERT INTO users(`name`, `student_id`) VALUES (:name, :studentId)");
        $result = $conn->executePrepared($stmt,[
            'name' => $data->getName(),
            'studentId' => $data->getStudentId(),
        ],[
            'name' => Column::BIND_PARAM_STR,
            'studentId' => Column::BIND_PARAM_STR
        ]);
        return $result;
    }

    public function delete(int $id) {
        //TODO : Delete
    }

    function getByStudentId(String $studentId) {
        $conn = $this->getConnection();
        $stmt = $conn->prepare("SELECT * FROM courses WHERE student_id = :studentId ");
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