<?php

namespace Domain\Elearning\Interactor;

use Domain\Elearning\Service\UserService;
use Domain\Elearning\Service\CourseService;
use Domain\Elearning\Service\EnrollmentService;
use Domain\Elearning\Presenter\UserPresenter;
use Domain\Elearning\Entity\UserEntity;
use Domain\Elearning\Exception\NotFoundException;
use Domain\Elearning\Entity\EnrollmentEntity;

class ViewUser {
    private $userService;
    private $courseService;
    private $enrollmentService;

    private $presenter;

    public function __construct(
        UserService $userService,
        CourseService $courseService,
        EnrollmentService $enrollmentService,
        UserPresenter $presenter
        )
    {
        $this->userService = $userService;
        $this->courseService = $courseService;
        $this->enrollmentService = $enrollmentService;
        $this->presenter = $presenter;
    }

    public function viewUserById(int $id) : void {
        $user = $this->userService->getUserById($id);
        if($user == null) {
            throw new NotFoundException("User with id ".$id);
        }
        $user = $this->processUser($user);
        $this->presenter->present($user);
    }

    public function viewUserByStudentId(string $studentId) : void {
        $user = $this->userService->getUserByStudentId($studentId);
        if($user == null) {
            throw new NotFoundException("User with student id ".$studentId);
        }
        $user = $this->processUser($user);
        $this->presenter->present($user);
    }

    private function processUser(UserEntity $user) : UserEntity {
        $enrollements = $this->enrollmentService->getByUser($user);
        /**
         * @var EnrollmentEntity $enrollment
         */
        foreach($enrollements as $enrollment) {
            $course = $this->courseService->getCourseById($enrollment->getId());
            $user->addCourse($course);
        }
        return $user;
    }

}