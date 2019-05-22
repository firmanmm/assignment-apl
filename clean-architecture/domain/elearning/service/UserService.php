<?php

namespace Domain\Elearning\Service;

use Domain\Elearning\Entity\UserEntity;
use Domain\Elearning\Repository\UserRepositoryInterface;
use Domain\Elearning\Exception\InvalidFormatException;

class UserService {
    /**
     * User Repository
     *
     * @var UserRepositoryInterface
     */
    private $repository;

    public function __construct(UserRepositoryInterface $repository) {
        $this->repository = $repository;
    }


    /**
     * Return all users
     *
     * @return UserEntity[]
     */
    public function getAllUser() : array {
        return $this->repository->getAll();
    }

    /**
     * Get user by its ID
     *
     * @param integer $id
     * @return UserEntity
     */
    public function getUserById(int $id) : UserEntity {
        return $this->repository->getById($id);
    }

    /**
     * Get user by its student id
     *
     * @param String $studentId
     * @return UserEntity
     */
    public function getUserByStudentId(String $studentId) : UserEntity {
        if(strlen($studentId) != 14) {
            throw new InvalidFormatException("Student ID's length is ".strlen($studentId)." expected is 14");
        }
        return $this->repository->getByStudentId($studentId);
    }

    public function saveUser(UserEntity $user) : UserEntity {
        if($user->getId() == 0){
            return $this->repository->insert($user);
        }else {
            return $this->repository->update($user);
        }
    }
}