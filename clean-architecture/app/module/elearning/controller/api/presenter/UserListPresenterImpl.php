<?php

namespace App\Elearning\Controllers\Api\Presenter;

use Domain\Elearning\Presenter\UserListPresenter;
use Phalcon\Http\Response;

class UserListPresenterImpl implements UserListPresenter {
    public function present(array $userList): void
    {
        $response = new Response();
        $response->setJsonContent($userList);
        $response->send();
        die();
    }
}