<?php
namespace App\Elearning\Controllers\Web;

use Phalcon\Mvc\Controller;
use App\Elearning\Controllers\Web\Presenter\UserListPresenterImpl;
use Domain\Elearning\Interactor\ListUser;
use Domain\Elearning\Interactor\AddUser;
use App\Elearning\Controllers\Web\Presenter\UserPostPresenterImpl;

class UserController extends Controller {
    public function homeAction() {
        $presenter = new UserListPresenterImpl($this->view);
        $interactor = new ListUser($this->userService, $presenter);
        $interactor->listUser();
    }

    public function postAction() {
        $presenter = new UserPostPresenterImpl();
        $interactor = new AddUser($this->userService, $presenter);
        $name = $this->request->getPost('name');
        $studentId = $this->request->getPost('studentId');
        $password = $this->request->getPost('password');
        try{
            $interactor->addUser($name,$studentId,$password);
        } catch (Exception $e) {
            $this->response->setStatusCode(500);
            $this->response->setJsonContent(["error" => $e->getMessage()]);
            $this->response->send();
            die();
        }
        $this->homeAction();
    }
}