<?php

namespace Domain\Elearning\Interactor;

use Domain\Elearning\Service\UserService;
use Domain\Elearning\Service\CourseService;
use Domain\Elearning\Presenter\EnrollmentFormPresenter;

class EnrollmentForm {
    private $courseService;
    private $userService;
    private $presenter;

    public function __construct(UserService $userService, CourseService $courseService, EnrollmentFormPresenter $presenter)
    {
        $this->userService = $userService;
        $this->courseService = $courseService;
        $this->presenter = $presenter;
    }

    public function showForm() : void {
        $courses = $this->courseService->getAllCourse();
        $user = $this->userService->getAllUser();
        $this->presenter->present($courses, $user);
    }
}