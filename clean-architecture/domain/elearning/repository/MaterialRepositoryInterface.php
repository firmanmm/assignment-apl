<?php

namespace Domain\Elearning\Repository;

use Domain\Elearning\Entity\CourseEntity;
use Domain\Elearning\Entity\MaterialEntity;

interface MaterialRepositoryInterface {
    /**
     * Array of material
     *
     * @param CourseEntity $course
     * @return array
     */
    function getAll(): array;
    function getById(int $id): ?MaterialEntity;
    function update(MaterialEntity $data) : MaterialEntity;
    function insert(MaterialEntity $data) : MaterialEntity;
    function delete(int $id);
    /**
     * Array of material
     *
     * @param int $courseId
     * @return CourseEntity[]
     */
    public function getByCourseId(int $courseId) : array;
}