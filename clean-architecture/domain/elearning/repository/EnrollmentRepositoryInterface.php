<?php

namespace Domain\Elearning\Repository;

use Domain\Elearning\Entity\EnrollmentEntity;

interface EnrollmentRepositoryInterface {
    /**
     * Return an array of EnrollmentEntity
     *
     * @return EnrollmentEntity[]
     */
    function getAll(): array;
    function getById(int $id): ?EnrollmentEntity;
    function insert(EnrollmentEntity $data) : EnrollmentEntity;
    function delete(int $id) : void;
    /**
     * Return array of enrollments
     *
     * @param int $userId
     * @return array
     */
    function getEnrollmentsByUserId(int $userId) : array;
    /**
     * Return array of enrollments
     *
     * @param int $courseId
     * @return array
     */
    function getEnrollmentsByCourseId(int $courseId) : array;
}

