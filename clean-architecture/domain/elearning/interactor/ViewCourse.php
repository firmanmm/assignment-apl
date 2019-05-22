<?php

namespace Domain\Elearning\Interactor;

use Domain\Elearning\Service\CourseService;
use Domain\Elearning\Service\EnrollmentService;
use Domain\Elearning\Service\MaterialService;
use Domain\Elearning\Presenter\CoursePresenter;
use Domain\Elearning\Exception\NotFoundException;
use Domain\Elearning\Service\UserService;
use Domain\Elearning\Entity\EnrollmentEntity;
use Domain\Elearning\Entity\CourseEntity;
use Domain\Elearning\Entity\MaterialEntity;
use Domain\Elearning\Service\QRService;

class ViewCourse {
    private $courseService;
    private $userService;
    private $enrollmentService;
    private $materialService;
    private $qRService;

    private $presenter;

    public function __construct(
        CourseService $courseService,
        UserService $userService,
        EnrollmentService $enrollmentService, 
        MaterialService $materialService, 
        QRService $qRService,
        CoursePresenter $presenter
        )
    {
        $this->courseService = $courseService;
        $this->userService = $userService;
        $this->enrollmentService = $enrollmentService;
        $this->materialService = $materialService;
        $this->presenter = $presenter;
        $this->qRService = $qRService;
    }

    public function viewCourseById(int $id) : void {
        $course = $this->courseService->getCourseById($id);
        if($course == null) {
            throw new NotFoundException("Course with id [".$id."]");
        }
        $course = $this->processCourse($course);
        $this->presenter->present($course, $this->qRService->generateAsString($course->getCourseId()));
    }

    public function viewCourseByCourseId(string $courseId) : void {
        $course = $this->courseService->getCourseByCourseId($courseId);
        if($course == null) {
            throw new NotFoundException("Course with course id [".$courseId."]");
        }
        $course = $this->processCourse($course);
        $this->presenter->present($course, $this->qRService->generateAsString($course->getCourseId()));
    }

    private function processCourse(CourseEntity $course) : CourseEntity {
        
        $enrollments = $this->enrollmentService->getByCourse($course);
        /**
         * @var EnrollmentEntity $enrolled
         */
        foreach($enrollments as $enrolled) {
            $user = $this->userService->getUserById($enrolled->getUser()->getId());
            $course->enroll($user);
        }
        $materials = $this->materialService->getAllMaterialByCourse($course);
        /**
         * @var MaterialEntity $material
         */
        foreach($materials as $material) {
            $course->addMaterial($material);
        }
        return $course;
    }
}