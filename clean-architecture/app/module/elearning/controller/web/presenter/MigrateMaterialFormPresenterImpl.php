<?php

namespace App\Elearning\Controllers\Web\Presenter;

use Domain\Elearning\Presenter\MigrateMaterialFormPresenter;
use Domain\Elearning\Entity\CourseEntity;
use Phalcon\Mvc\View;

class MigrateMaterialFormPresenterImpl implements MigrateMaterialFormPresenter {

    private $view;

    public function __construct(View $view)
    {
        $this->view = $view;
    }

    public function present(CourseEntity $course, array $courseList) : void
    {
        $materials = $course->getMaterials();     
        foreach($materials as $key => $value) {
            $materials[$key] = $value->jsonSerialize();
        }
        $courses = [];
        foreach($courseList as $courseInstance) {
            $courses[] = $courseInstance->jsonSerialize();
        }
        $source = $course->jsonSerialize();
        $this->view->setVar("source", $source);
        $this->view->setVar("materials", $materials);
        $this->view->setVar("courses", $courses);
        $this->view->pick("migrate/home");
    }
}   