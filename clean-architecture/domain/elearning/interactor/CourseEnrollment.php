<?php
use Domain\Elearning\Service\CourseEnrollmentService;
use Domain\Elearning\Presenter\EnrollmentPresenter;
use Domain\Elearning\Entity\CourseEntity;
use Domain\Elearning\Entity\UserEntity;

class Enrollment {
    private $courseEnrollmentService;
    private $presenter;

    public function __construct(
        CourseEnrollmentService $courseEnrollmentService, 
        EnrollmentPresenter $enrollmentPresenter)
    {
        $this->courseEnrollmentService = $courseEnrollmentService;
        $this->presenter = $enrollmentPresenter;
    }

    public function enroll(CourseEntity $course, UserEntity $user) : void {
        $enrollment = $this->courseEnrollmentService->enrollUser($course, $user);
        $this->presenter->present($enrollment);
    }
}