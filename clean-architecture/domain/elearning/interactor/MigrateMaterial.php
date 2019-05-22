<?php 

namespace Domain\Elearning\Interactor;

use Domain\Elearning\Service\CourseMaterialService;
use Domain\Elearning\Presenter\CoursePresenter;
use Domain\Elearning\Entity\CourseEntity;
use Domain\Elearning\Entity\MaterialEntity;
use Domain\Elearning\Service\CourseService;
use Domain\Elearning\Exception\NotFoundException;

class MigrateMaterial {
    private $courseService;
    private $courseMaterialService;
    private $presenter;

    public function __construct(CourseService $courseService, CourseMaterialService $courseMaterial, CoursePresenter $presenter)
    {
        $this->courseService = $courseService;
        $this->courseMaterialService = $courseMaterial;
        $this->presenter = $presenter;
    }

    /**
     * Migrate Materia
     *
     * @param integer $source
     * @param integer $destination
     * @param int[] $materials
     * @return void
     */
    public function migrateMaterial(int $sourceId, int $destinationId, array $materials) : void {
        $source = $this->courseService->getCourseById($sourceId);
        if($source == null) {
            throw new NotFoundException();
        }
        $destination = $this->courseService->getCourseById($destinationId);
        if($destination == null) {
            throw new NotFoundException();
        }
        $destination = $this->courseMaterialService->migrate($source, $destination, $materials);
        $this->presenter->present($destination);
    }
}