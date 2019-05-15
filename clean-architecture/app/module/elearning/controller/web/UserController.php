<?php
namespace App\Elearning\Controllers\Web;

use Phalcon\Mvc\Controller;
use Domain\Elearning\Service\UserService;
use function GuzzleHttp\json_encode;
use function GuzzleHttp\json_decode;
use Domain\Elearning\Entity\UserEntity;

class UserController extends Controller {
    public function homeAction() {
        /**
         * @var UserService $userService
         */
        $userService = $this->userService;
        $raw = json_encode($userService->getAllUser());
        $decoded = json_decode($raw);
        $this->view->setVar("students", $decoded);
        $this->view->pick('student/home');
    }

    public function postAction() {
        /**
         * @var UserService $userService
         */
        $userService = $this->userService;
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
        } catch (Exception $e) {
            $this->response->setStatusCode(500);
            $this->response->setJsonContent(["error" => $e->getMessage()]);
            $this->response->send();
            die();
        }
        $this->homeAction();
    }
}