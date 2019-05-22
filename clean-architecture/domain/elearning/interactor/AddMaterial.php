<?php

namespace Domain\Elearning\Interactor;

use Domain\Elearning\Service\MaterialService;
use Domain\Elearning\Presenter\MaterialPresenter;
use Domain\Elearning\Entity\CourseEntity;
use Domain\Elearning\Service\CourseMaterialService;
use Domain\Elearning\Entity\MaterialEntity;

class AddMaterial {

    private $courseMaterialService;
    private $presenter;

    public function __construct(
        CourseMaterialService $courseMaterialService, 
        MaterialPresenter $presenter)
    {
        $this->courseMaterialService = $courseMaterialService;
        $this->presenter = $presenter;
    }

    public function addMaterial(
        CourseEntity $course,
        string $title,
        string $description
    ) : void {
        $material = new MaterialEntity();
        $material->setTitle($title);
        $material->setDescription($description);
        $material = $this->courseMaterialService->addMaterial($course, $material);
        $this->presenter->present($material);
    }
}