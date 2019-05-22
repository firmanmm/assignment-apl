<?php

namespace Domain\Elearning\Repository;

use Domain\Elearning\Entity\CourseEntity;

interface CourseRepositoryInterface {
    /**
     * Return an array of CourseEntity
     *
     * @return array
     */
    function getAll(): array;
    function getById(int $id): ?CourseEntity;
    function update(CourseEntity $data) : CourseEntity;
    function insert(CourseEntity $data) : CourseEntity;
    function delete(int $id);
    function getByCourseId(String $courseId) : ?CourseEntity;
}