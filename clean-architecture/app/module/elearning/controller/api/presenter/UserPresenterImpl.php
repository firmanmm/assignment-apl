<?php

namespace App\Elearning\Controllers\Api\Presenter;

use Domain\Elearning\Presenter\UserPresenter;
use Phalcon\Http\Response;
use Domain\Elearning\Entity\UserEntity;

class UserPresenterImpl implements UserPresenter {
    public function present(UserEntity $user): void
    {
        $response = new Response();
        $json = $user->jsonSerialize();
        $json["courses"] = $user->getCourses();
        $response->setJsonContent($json);
        $response->send();
        die();
    }
}