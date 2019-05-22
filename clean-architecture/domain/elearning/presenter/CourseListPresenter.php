<?php

namespace Domain\Elearning\Presenter;

use Domain\Elearning\Entity\CourseEntity;

interface CourseListPresenter {
    /**
     * Present
     *
     * @param CourseEntity[] $courseList
     * @return void
     */
    public function present(array $courseList) : void;
}