<?php

namespace App\Elearning\Controllers\Api\Presenter;

use Domain\Elearning\Presenter\CourseListPresenter;
use Phalcon\Http\Response;

class CourseListPresenterImpl implements CourseListPresenter {
    public function present(array $courseList): void
    {
        $response = new Response();
        $response->setJsonContent($courseList);
        $response->send();
        die();
    }
}