<?php

namespace Domain\Elearning\Interactor;

use Domain\Elearning\Service\MaterialService;
use Domain\Elearning\Presenter\MaterialListPresenter;
use Domain\Elearning\Service\CourseService;

class ListMaterial {
    private $courseService;
    private $materialService;
    private $presenter;

    public function __construct(MaterialService $materialService, CourseService $courseService, MaterialListPresenter $presenter)
    {
        $this->courseService = $courseService;
        $this->materialService = $materialService;
        $this->presenter = $presenter;
    }

    public function listMaterial() : void {
        $courseList = $this->courseService->getAllCourse();
        $materialList = $this->materialService->getAllMaterial();
        $this->presenter->present($materialList, $courseList);
    }
}