<?php

namespace Domain\Elearning\Service;

use Domain\Elearning\Entity\EnrollmentEntity;
use Domain\Elearning\Entity\UserEntity;
use Domain\Elearning\Entity\CourseEntity;

class CourseEnrollmentService {

    /**
     * Course Service
     *
     * @var CourseService
     */
    private $courseService;
    /**
     * Enrollment Service
     *
     * @var EnrollmentService
     */
    private $enrollmentService;

    public function __construct(CourseService $courseService, EnrollmentService $enrollmentService)
    {
        $this->courseService = $courseService;
        $this->enrollmentService = $enrollmentService;
    }

    /**
     * Entroll given student id to
     *
     * @param CourseEntity $course
     * @param UserEntity $user
     * @return CourseEntity
     */
    public function enrollUser(CourseEntity $course, UserEntity $user) : EnrollmentEntity {
        $course->enroll($user);
        $enrollment = new EnrollmentEntity(0);
        $enrollment->setCourse($course);
        $enrollment->setUser($user);
        return $this->enrollmentService->save($enrollment);
    }
}