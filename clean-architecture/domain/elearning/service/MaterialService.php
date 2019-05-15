<?php

namespace Domain\Elearning\Service;

use Domain\Elearning\Repository\MaterialRepositoryInterface;
use Domain\Elearning\Entity\MaterialEntity;

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


    /**
     * Get all materials
     *
     * @return MaterialEntity[]
     */
    public function getAllMaterial() {
        return $this->repository->getAll();
    }

    public function saveMaterial(MaterialEntity $material) {
        return $this->repository->save($material);
    }

    public function getAllMaterialByCourseId($courseId) {
        return $this->repository->getByCourseId($courseId);
    }
}