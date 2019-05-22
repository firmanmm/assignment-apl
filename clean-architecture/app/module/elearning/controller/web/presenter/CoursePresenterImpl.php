<?php

namespace App\Elearning\Controllers\Web\Presenter;

use Domain\Elearning\Presenter\CoursePresenter;
use Domain\Elearning\Entity\CourseEntity;
use Phalcon\Mvc\View;
use Domain\Elearning\Service\QRService;

class CoursePresenterImpl implements CoursePresenter {
    private $view;
    private $qRService;

    public function __construct(View $view, QRService $qRService)
    {
        $this->view = $view;
        $this->qRService = $qRService;
    }

    public function present(CourseEntity $course): void
    {
        $qrData = $this->qRService->generateAsString($course->getCourseId());
        $this->view->setVars($this->makeCourse($course, $qrData));
        $this->view->pick("course/detail");
    }

    private function makeCourse(CourseEntity $course, string $qrData): array {
        $students = $course->getAllUser();
        foreach($students as $key => $student) {
            $students[$key] = $student->jsonSerialize();
        }
        $materials = $course->getMaterials();
        foreach($materials as $key => $value) {
            $materials[$key] = $value->jsonSerialize();
        }
        $result = [
            "course" => $course->jsonSerialize(),
            "students" => $students,
            "materials" => $materials,
            "qrCode" => $qrData,
        ];
        return $result;
    }
}