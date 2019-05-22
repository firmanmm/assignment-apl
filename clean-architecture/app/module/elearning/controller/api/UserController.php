<?php

namespace App\Elearning\Controllers\Api;

use Phalcon\Mvc\Controller;
use Domain\Elearning\Entity\UserEntity;
use Exception;
use App\Elearning\Controllers\Api\Presenter\UserListPresenterImpl;
use Domain\Elearning\Interactor\ListUser;
use App\Elearning\Controllers\Api\Presenter\UserPresenterImpl;
use Domain\Elearning\Interactor\ViewUser;
use Domain\Elearning\Interactor\AddUser;

class UserController extends Controller {

    public function getAllAction() {
        $presenter = new UserListPresenterImpl();
        $interactor = new ListUser($this->userService,$presenter);
        $interactor->listUser();
    }

    public function getByIdAction($id) {
        $presenter = new UserPresenterImpl();
        $interactor = new ViewUser(
            $this->userService,
            $this->courseService,
            $this->enrollmentService,
            $presenter);

        $interactor->viewUserById($id);
    }

    public function postAction() {
        $presenter = new UserPresenterImpl();
        $interactor = new AddUser($this->userService,$presenter);
        $name = $this->request->getPost('name');
        $studentId = $this->request->getPost('studentId');
        $password = $this->request->getPost('password');
        $interactor->addUser($name,$studentId,$password);
    }
}