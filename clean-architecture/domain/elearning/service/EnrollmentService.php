<?php

namespace Domain\Elearning\Service;

use Domain\Elearning\Repository\EnrollmentRepositoryInterface;
use Domain\Elearning\Entity\EnrollmentEntity;
use Domain\Elearning\Entity\UserEntity;
use Domain\Elearning\Entity\CourseEntity;

class EnrollmentService {
    /**
     * Repository
     *
     * @var EnrollmentRepositoryInterface
     */
    private $repository;

    public function __construct(EnrollmentRepositoryInterface $enrollmentRepositoryInterface)
    {
        $this->repository = $enrollmentRepositoryInterface;
    }

    public function getById(int $id) : ?EnrollmentEntity {
        return $this->repository->getById($id);
    }

    public function save(EnrollmentEntity $enrollment) : EnrollmentEntity{
        if($enrollment->getId() == 0) {
            return $this->repository->insert($enrollment);
        }
        return $this->repository->update($enrollment);
    }

    /**
     * Return all enrollment data by UserEntity
     *
     * @param \Domain\Elearning\Entity\UserEntity $userEntity
     * @return UserEntity[]
     */
    public function getByUser(UserEntity $userEntity) : array {
        return $this->repository->getEnrollmentsByUser($userEntity);
    }

    public function getByCourse(CourseEntity $courseEntity) : array {
        return $this->repository->getEnrollmentsByCourse($courseEntity);
    }
}