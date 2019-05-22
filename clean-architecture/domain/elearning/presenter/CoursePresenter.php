<?php

namespace Domain\Elearning\Presenter;

use Domain\Elearning\Entity\CourseEntity;

interface CoursePresenter {
    public function present(CourseEntity $course) : void;
}