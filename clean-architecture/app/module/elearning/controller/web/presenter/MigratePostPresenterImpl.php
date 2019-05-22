<?php

namespace App\Elearning\Controllers\Web\Presenter;

use Domain\Elearning\Presenter\CoursePresenter;
use Phalcon\Http\Response;

class MigratePostPresenterImpl implements CoursePresenter {
    public function present(\Domain\Elearning\Entity\CourseEntity $course): void
    {
        $response = new Response();
        $response->redirect("/course/",$course->getId());
        $response->send();
        die();
    }
}