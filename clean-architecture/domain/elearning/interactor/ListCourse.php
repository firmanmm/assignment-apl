<?php

namespace Domain\Elearning\Interactor;

use Domain\Elearning\Service\CourseService;
use Domain\Elearning\Presenter\CourseListPresenter;

class ListCourse {

    private $courseService;
    private $presenter;

    public function __construct(CourseService $courseService, CourseListPresenter $presenter)
    {
        $this->courseService = $courseService;
        $this->presenter = $presenter;
    }

    public function listCourse() {
        $courseList = $this->courseService->getAllCourse();
        $this->presenter->present($courseList);
    }
}