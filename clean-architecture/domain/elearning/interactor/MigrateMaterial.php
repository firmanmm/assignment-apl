<?php 

namespace Domain\Elearning\Interactor;

use Domain\Elearning\Service\CourseMaterialService;
use Domain\Elearning\Presenter\CoursePresenter;
use Domain\Elearning\Entity\CourseEntity;
use Domain\Elearning\Entity\MaterialEntity;

class MigrateMaterial {
    private $courseMaterialService;
    private $presenter;

    public function __construct(CourseMaterialService $courseMaterial, CoursePresenter $presenter)
    {
        $this->courseMaterialService = $courseMaterial;
        $this->presenter = $presenter;
    }

    /**
     * Migrate Material from one service to another
     *
     * @param \Domain\Elearning\Entity\CourseEntity $source
     * @param \Domain\Elearning\Entity\CourseEntity $destination
     * @param MaterialEntity[] $materials
     * @return void
     */
    public function migrateMaterial(CourseEntity $source, CourseEntity $destination, array $materials) : void {
        $destination = $this->courseMaterialService->migrate($source, $destination, $materials);
        $this->presenter->present($destination);
    }
}