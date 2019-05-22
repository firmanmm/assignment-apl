<?php

namespace Domain\Elearning\Presenter;

use Domain\Elearning\Entity\MaterialEntity;
use Domain\Elearning\Entity\CourseEntity;

interface MaterialListPresenter {
    /**
     * Present
     *
     * @param MaterialEntity[] $materialList
     * @param CourseEntity[] $courseList
     * @return void
     */
    public function present(array $materialList, array $courseList) : void;
}