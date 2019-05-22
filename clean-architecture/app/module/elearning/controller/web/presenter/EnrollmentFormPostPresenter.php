<?php

namespace App\Elearning\Controllers\Web\Presenter;

use Domain\Elearning\Presenter\EnrollmentPresenter;
use Domain\Elearning\Entity\EnrollmentEntity;
use Phalcon\Http\Response;

class EnrollmentFormPostPresenter implements EnrollmentPresenter {
    public function present(EnrollmentEntity $enrollmentEntity): void
    {
        $response = new Response();
        $response->redirect("/course/".$enrollmentEntity->getCourse()->getId());
        $response->send();
        die();
    }
}