<?php

namespace Domain\Elearning\Service;

use Exception;
use Domain\Elearning\Entity\UserEntity;
use Domain\Elearning\Entity\CourseEntity;
use Domain\Elearning\Repository\CourseRepositoryInterface;

class CourseService {

    /**
     * Repository
     *
     * @var CourseRepositoryInterface
     */
    private $repository;

    public function __construct(CourseRepositoryInterface $repository) {
        $this->repository = $repository;
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

    public function saveCourse(CourseEntity $course) {
        $this->repository->save($course);
    }

    public function enrollUser(int $courseId, String $studentId) : bool {
        $course = $this->getCourseById($courseId);
        if($course == null) {
            throw new Exception("Course not found");
        }
        if(!$course->enroll($studentId)){
            throw new Exception("Course if full");
        }
        $this->repository->save($course);
        return true;
    }

    
}