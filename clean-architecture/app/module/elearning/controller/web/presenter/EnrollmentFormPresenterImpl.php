<?php

namespace App\Elearning\Controllers\Web\Presenter;

use Domain\Elearning\Presenter\EnrollmentFormPresenter;
use Phalcon\Mvc\View;

class EnrollmentFormPresenterImpl implements EnrollmentFormPresenter {
    private $view;
    public function __construct(View $view)
    {
        $this->view = $view;
    }

    public function present(array $courseList, array $studentList) : void
    {
        $this->view->setVar("courses", $this->makeCourse($courseList));
        $this->view->setVar("students", $this->makeStudents($studentList));
        $this->view->pick("enrollment/home");
    }

    private function makeCourse(array $courseList) : array {
        $courses = [];
        foreach($courseList as $course) {
            $courses[] = $course->jsonSerialize();
        }
        return $courses;
    }

    private function makeStudents(array $userList): array {
        $students = [];
        /**
         * @var UserEntity $student
         */
        foreach($userList as $student) {
            $students[] = $student->jsonSerialize();
        }
        return $students;
    }
}