<?php

namespace Domain\Elearning\Service;

use Domain\Elearning\Repository\MaterialRepositoryInterface;
use Domain\Elearning\Entity\MaterialEntity;
use Domain\Elearning\Entity\CourseEntity;

class MaterialService {

    /**
     * Material's repository
     *
     * @var MaterialRepositoryInterface
     */
    private $repository;

    public function __construct(MaterialRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function getById(int $id) : ?MaterialEntity {
        return $this->repository->getById($id);
    }

    /**
     * Get all materials
     *
     * @return MaterialEntity[]
     */
    public function getAllMaterial() : array {
        return $this->repository->getAll();
    }

    public function saveMaterial(MaterialEntity $material) : MaterialEntity {
        if ($material->getId() == 0) {
            return $this->repository->insert($material);
        }else{
            return $this->repository->update($material);
        }
    }

    public function getAllMaterialByCourse(CourseEntity $course) : array {
        return $this->repository->getByCourseId($course->getId());
    }
}