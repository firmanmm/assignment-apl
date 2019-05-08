<?php

namespace Domain\Elearning\Repository;

use Domain\Elearning\Repository\RepositoryInterface;

interface CourseRepositoryInterface extends RepositoryInterface{
    function getByCourseId(String $courseId);
}