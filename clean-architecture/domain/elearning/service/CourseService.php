<?php

namespace Domain\Elearning\Service;

use Exception;
use Domain\Elearning\Entity\CourseEntity;
use Domain\Elearning\Repository\CourseRepositoryInterface;
use Domain\Elearning\Entity\MaterialEntity;
use Domain\Elearning\Repository\UserCourseRepositoryInterface;

class CourseService {

    /**
     * Repository
     *
     * @var CourseRepositoryInterface
     */
    private $repository;
    /**
     * Relation Repository
     *
     * @var UserCourseRepositoryInterface
     */
    private $relationRepository;
    /**
     * User Service
     *
     * @var UserService
     */
    private $userService;

    public function __construct(CourseRepositoryInterface $repository, UserCourseRepositoryInterface $relationRepository, UserService $userService) {
        $this->repository = $repository;
        $this->userService = $userService;
        $this->relationRepository = $relationRepository;
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

    public function getUsersByCourseId(int $courseId) {
        $users = [];
        $userIds = $this->relationRepository->getUsersByCourseId($courseId);
        foreach($userIds as $id) {
            $users[] = $this->userService->getUserById($id);
        }
        return $users;
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
    public function saveCourse(CourseEntity $course) {
        return $this->repository->save($course);
    }

    /**
     * Entroll given student id to
     *
     * @param integer $courseId
     * @param integer $studentId
     * @return CourseEntity
     */
    public function enrollUser(int $courseId, string $studentId) {
        $course = $this->getCourseById($courseId);
        if($course == null) {
            throw new Exception("Course not found");
        }
        $user = $this->userService->getUserByStudentId($studentId);
        if($user == null){
            throw new Exception("Student not found!");
        }
        $userIds = $this->relationRepository->getUsersByCourseId($courseId);
        $userIds[] = $user->getId();
        foreach($userIds as $id){
            if(!$course->enroll($id)){
                throw new Exception("Course if full");
            }
        }
        $this->relationRepository->saveByCourse($course);
        return true;
    }

    /**
     * Add material to a given course id
     *
     * @param integer $courseId
     * @param integer $materialId
     * @return \Domain\Elearning\Entity\CourseEntity
     */
    public function addMaterial(int $courseId, int $materialId) {
        $course = $this->getCourseById($courseId);
        if($course == null) {
            throw new Exception("Course not found");
        }
        $course->addMaterial($materialId);
        $this->repository->save($course);
        return true;
    }

    public function deleteCourse(int $courseId) {
        $this->repository->delete($courseId);
    }
}