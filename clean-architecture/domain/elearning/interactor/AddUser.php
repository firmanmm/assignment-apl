<?php

namespace Domain\Elearning\Interactor;

use Domain\Elearning\Service\UserService;
use Domain\Elearning\Presenter\UserPresenter;
use Domain\Elearning\Entity\UserEntity;

class AddUser {
    private $userService;
    private $presenter;

    public function __construct(UserService $userService, UserPresenter $presenter)
    {
        $this->userService = $userService;
        $this->presenter = $presenter;
    }

    public function addUser(
        string $name,
        string $studentId,
        string $password
    ) : void {
        $user = new UserEntity();
        $user->setName($name);
        $user->setStudentId($studentId);
        $user->setPassword(\password_hash($password, \PASSWORD_BCRYPT));
        $this->userService->saveUser($user);
        $user = $this->userService->saveUser($user);
    }
}