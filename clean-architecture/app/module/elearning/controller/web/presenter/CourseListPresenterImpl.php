<?php

namespace App\Elearning\Controllers\Web\Presenter;

use Domain\Elearning\Presenter\CourseListPresenter;
use Phalcon\Mvc\View;

class CourseListPresenterImpl implements CourseListPresenter {

    private $view;

    public function __construct(View $view)
    {
        $this->view = $view;
    }

    public function present(array $courseList): void
    {
        $this->view->setVar("courses", $this->makeCourse($courseList));
        $this->view->pick("course/home");
    }

    private function makeCourse(array $courseList) : array {
        $courses = [];
        foreach($courseList as $course) {
            $courses[] = $course->jsonSerialize();
        }
        return $courses;
    }
}