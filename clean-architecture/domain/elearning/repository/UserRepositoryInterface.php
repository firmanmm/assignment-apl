<?php

namespace Domain\Elearning\Repository;

use Domain\Elearning\Entity\UserEntity;

interface UserRepositoryInterface {
    /**
     * Return an array of UserRepository
     *
     * @return array
     */
    function getAll(): array;
    function getById(int $id): ?UserEntity;
    function update(UserEntity $data) : UserEntity;
    function insert(UserEntity $data) : UserEntity;
    function delete(int $id) : void;
    function getByStudentId(String $studentId) : ?UserEntity;
}