<?php

namespace Domain\Elearning\Service;

use Exception;
use Domain\Elearning\Entity\CourseEntity;
use Domain\Elearning\Repository\CourseRepositoryInterface;
use chillerlan\QRCode\QRCode;

class CourseService {

    /**
     * Repository
     *
     * @var CourseRepositoryInterface
     */
    private $repository;

    public function __construct(CourseRepositoryInterface $courseRepositoryInterface) {
        $this->repository = $courseRepositoryInterface;
    }

    public function getAllCourse()  {
        return $this->repository->getAll();
    }

    /**
     * Get Course by Id
     *
     * @param integer $id
     * @return CourseEntity
     */
    public function getCourseById(int $id) {
        return $this->repository->getById($id);
    }

    /**
     * Get Course by its course id
     *
     * @param String $courseId
     * @return CourseEntity
     */
    public function getCourseByCourseId(String $courseId) {
        if(count($courseId) != 6) {
            throw new Exception("Invalid course id format");
        }
        return $this->repository->getByCourseId($courseId);
    }

    /**
     * Course Entity
     *
     * @param \Domain\Elearning\Entity\CourseEntity $course
     * @return \Domain\Elearning\Entity\CourseEntity
     */
    public function saveCourse(CourseEntity $course) : CourseEntity {
        if($course->getId() == 0){
            return $this->repository->insert($course);
        }
        return $this->repository->update($course);
    }

    public function deleteCourse(int $courseId) {
        $this->repository->delete($courseId);
    }
}