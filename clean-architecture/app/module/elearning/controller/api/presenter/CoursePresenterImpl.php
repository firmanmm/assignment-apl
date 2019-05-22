<?php

namespace App\Elearning\Controllers\Api\Presenter;

use Domain\Elearning\Presenter\CoursePresenter;
use Phalcon\Http\Response;

class CoursePresenterImpl implements CoursePresenter {
    public function present(\Domain\Elearning\Entity\CourseEntity $course): void
    {
        $response = new Response();
        $json = $course->jsonSerialize();
        $json["users"] = $course->getAllUser();
        $json["materials"] = $course->getMaterials();
        $response->setJsonContent($json);
        $response->send();
        die();
    }
}