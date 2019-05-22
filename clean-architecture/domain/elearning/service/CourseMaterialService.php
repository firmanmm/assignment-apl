<?php

namespace Domain\Elearning\Service;

use Domain\Elearning\Entity\CourseEntity;
use Domain\Elearning\Entity\MaterialEntity;
use Domain\Elearning\Exception\NotPersistedException;
use Domain\Elearning\Exception\NotFoundException;

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

    /**
     * Undocumented function
     *
     * @param \Domain\Elearning\Entity\CourseEntity $source
     * @param \Domain\Elearning\Entity\CourseEntity $destination
     * @param CourseEntity
     * @return void
     */
    public function migrate(CourseEntity $source, CourseEntity $destination, array $materials) : CourseEntity {
        if($source->getId() == 0){
            throw new NotPersistedException("Source course");
        }
        if($destination->getId() == 0) {
            throw new NotPersistedException("Destination course");
        }

        foreach($materials as $material) {
            $newMaterial = $this->materialService->getById($material->getId());
            if($newMaterial == null) {
                throw new NotFoundException("Material with id : ".$material->getId());
            }
            $newMaterial->setId(0);
            $destination->addMaterial($this->materialService->saveMaterial($newMaterial));
        }
        return $destination;
    }

    public function addMaterial(CourseEntity $course, MaterialEntity $material) : MaterialEntity {
        if($course->getId() == 0) {
            throw new NotPersistedException("Material title : ".$material->getTitle());
        }
        $material->setCourseId($course->getId());
        $course->addMaterial($material);
        $this->materialService->saveMaterial($material);
        return $material;
    }
}