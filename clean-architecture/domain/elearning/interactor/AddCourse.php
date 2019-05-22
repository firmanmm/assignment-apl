<?php

namespace Domain\Elearning\Interactor;

use Domain\Elearning\Service\CourseService;
use Domain\Elearning\Presenter\CoursePresenter;
use Domain\Elearning\Entity\CourseEntity;

class AddCourse {

    private $courseService;
    private $presenter;

    public function __construct(CourseService $courseService, CoursePresenter $coursePresenter)
    {
        $this->courseService = $courseService;      
        $this->presenter = $coursePresenter;  
    }

    public function addCourse(
        string $courseId,
        string $name,
        string $description,
        int $capacity
    ) : void {
        $course = new CourseEntity(0);
        $course->setName($name);
        $course->setDescription($description);
        $course->setCourseId($courseId);
        $course->setCapacity($capacity);
        $course = $this->courseService->saveCourse($course);
        $this->presenter->present($course);
    }
}