<?php


namespace Domain\Elearning\Presenter;

interface ListAllUserPresenterInterface {
    public function present(array $userList) : void;
}