<?php

namespace Domain\Elearning\Interactor;

use Domain\Elearning\Service\CourseEnrollmentService;
use Domain\Elearning\Presenter\EnrollmentPresenter;
use Domain\Elearning\Entity\CourseEntity;
use Domain\Elearning\Entity\UserEntity;
use Domain\Elearning\Service\CourseService;
use Domain\Elearning\Service\UserService;

class CourseEnrollment {
    private $courseService;
    private $userService;
    private $courseEnrollmentService;
    private $presenter;

    public function __construct(
        CourseService $courseService,
        UserService $userService,
        CourseEnrollmentService $courseEnrollmentService, 
        EnrollmentPresenter $enrollmentPresenter)
    {
        $this->courseService = $courseService;
        $this->userService = $userService;
        $this->courseEnrollmentService = $courseEnrollmentService;
        $this->presenter = $enrollmentPresenter;
    }

    public function enroll(int $courseId, int $userId) : void {
        $course = $this->courseService->getCourseById($courseId);
        $user = $this->userService->getUserById($userId);
        $enrollment = $this->courseEnrollmentService->enrollUser($course, $user);
        $this->presenter->present($enrollment);
    }
}