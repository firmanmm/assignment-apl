<?php

namespace Domain\Elearning\Presenter;

interface EnrollmentFormPresenter {
    public function present(array $courseList, array $studentList) : void;
}