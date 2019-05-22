<?php

namespace App\Elearning\Controllers\Web\Presenter;

use Domain\Elearning\Presenter\UserListPresenter;
use Phalcon\Mvc\View;
use Domain\Elearning\Entity\UserEntity;

class UserListPresenterImpl implements UserListPresenter {

    private $view;

    public function __construct(View $view)
    {
        $this->view = $view;
    }

    public function present(array $userList): void
    {
        $this->view->setVar("students", $this->makeStudents($userList));
        $this->view->pick("student/home");
    }

    private function makeStudents(array $userList): array {
        $students = [];
        /**
         * @var UserEntity $student
         */
        foreach($userList as $student) {
            $students[] = $student->jsonSerialize();
        }
        return $students;
    }
}