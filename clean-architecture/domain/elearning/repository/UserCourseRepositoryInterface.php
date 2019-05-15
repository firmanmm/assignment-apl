<?php

namespace Domain\Elearning\Repository;

use Domain\Elearning\Entity\CourseEntity;

interface UserCourseRepositoryInterface {
    function saveByCourse(CourseEntity $course);
    function getCoursesByUserId(int $userId);
    function getUsersByCourseId(int $courseId);
}

