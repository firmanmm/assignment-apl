<?php

namespace App\Elearning\Controllers\Api;

use Phalcon\Mvc\Controller;
use Domain\Elearning\Entity\UserEntity;
use Exception;

class UserController extends Controller {

    public function getAllAction() {
        $userService = $this->userService;
        $this->response->setJsonContent($userService->getAllUser());
        $this->response->send();
    }

    public function getByIdAction($id) {
        $userService = $this->userService;
        try {
            $user = $userService->getUserById($id);
        } catch(Exception $e){
            $this->response->setStatusCode(500);
            $this->response->setJsonContent(["error" => $e->getMessage()]);
            $this->response->send();
        }
        if($user == null){
            $this->response->setStatusCode(404);
        }
        $this->response->setJsonContent($user);
        $this->response->send();
    }

    public function postAction() {
        $name = $this->request->getPost('name');
        $studentId = $this->request->getPost('studentId');
        $password = $this->request->getPost('password');
        try{
            $user = new UserEntity(0);
            $user->setName($name);
            $user->setStudentId($studentId);
            $user->setPassword($password);
            $userService = $this->userService;
            $userService->saveUser($user);
            $this->response->setJsonContent($user);
            $this->response->send();
        } catch (Exception $e) {
            $this->response->setStatusCode(500);
            $this->response->setJsonContent(["error" => $e->getMessage()]);
            $this->response->send();
        }
    }
}