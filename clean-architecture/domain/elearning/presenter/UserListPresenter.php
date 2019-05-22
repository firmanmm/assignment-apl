<?php


namespace Domain\Elearning\Presenter;

use Domain\Elearning\Entity\UserEntity;

interface UserListPresenter {
    /**
     * Present
     *
     * @param UserEntity[] $userList
     * @return void
     */
    public function present(array $userList) : void;
}