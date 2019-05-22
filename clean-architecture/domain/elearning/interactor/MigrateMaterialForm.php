<?php

namespace Domain\Elearning\Interactor;

use Domain\Elearning\Service\CourseService;
use Domain\Elearning\Exception\NotFoundException;
use Domain\Elearning\Presenter\MigrateMaterialFormPresenter;
use Domain\Elearning\Service\MaterialService;
use Domain\Elearning\Entity\MaterialEntity;

class MigrateMaterialForm {
    private $courseService;
    private $materialService;

    private $presenter;

    public function __construct(
        CourseService $courseService, 
        MaterialService $materialService, 
        MigrateMaterialFormPresenter $migratePresenter)
    {
        $this->courseService = $courseService;
        $this->materialService = $materialService;
        $this->presenter = $migratePresenter;
    }


    public function showForm(int $courseId) : void {
        $course = $this->courseService->getCourseById($courseId);
        if($course == null){
            throw new NotFoundException("Course ID : ". $courseId);
        }
        $materials = $this->materialService->getAllMaterialByCourse($course);
        /**
         * @var MaterialEntity $material
         */
        foreach($materials as $material) {
            $course->addMaterial($material);
        }
        $courseList = $this->courseService->getAllCourse();
        $this->presenter->present($course, $courseList);
    }
}