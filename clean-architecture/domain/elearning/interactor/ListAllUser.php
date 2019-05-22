<?php

namespace Domain\Elearning\Interactor;

use Domain\Elearning\Service\UserService;
use Domain\Elearning\Presenter\ListAllUserPresenterInterface;

class ListAllUser {

    private $userService;
    private $presenter;

    public function __construct(UserService $userService, ListAllUserPresenterInterface $presenter)
    {  
        $this->userService = $userService;
        $this->presenter = $presenter;
    }

    public function listUser() : void {
        $userList = $this->userService->getAllUser();
        $this->presenter->present($userList);
    }
}
