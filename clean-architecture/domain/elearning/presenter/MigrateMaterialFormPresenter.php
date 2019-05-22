<?php

namespace Domain\Elearning\Presenter;

use Domain\Elearning\Entity\CourseEntity;

interface MigrateMaterialFormPresenter {
    public function present(CourseEntity $course, array $courseList) : void;
}