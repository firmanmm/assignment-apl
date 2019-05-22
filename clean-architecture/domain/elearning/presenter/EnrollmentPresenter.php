<?php

namespace Domain\Elearning\Presenter;

use Domain\Elearning\Entity\EnrollmentEntity;

interface EnrollmentPresenter {
    public function present(EnrollmentEntity $enrollmentEntity) : void;
}