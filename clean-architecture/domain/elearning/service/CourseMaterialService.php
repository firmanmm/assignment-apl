<?php

namespace Domain\Elearning\Service;

use Domain\Elearning\Entity\CourseEntity;
use Domain\Elearning\Entity\MaterialEntity;

class CourseMaterialService {
    /**
     * @var CourseService
     */
    private $courseService;
    /**
     * @var MaterialService
     */
    private $materialService;

    public function __construct(CourseService $courseService,MaterialService $materialService) {
        $this->courseService = $courseService;
        $this->materialService = $materialService;
    }

    public function addMaterial(CourseEntity $course, MaterialEntity $material) : MaterialEntity {
        $material->setCourseId($course->getId());
        $course->addMaterial($material);
        $this->materialService->saveMaterial($material);
        return $material;
    }
}