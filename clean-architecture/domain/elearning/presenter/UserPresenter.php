<?php

namespace Domain\Elearning\Presenter;

use Domain\Elearning\Entity\UserEntity;

interface UserPresenter {
    public function present(UserEntity $user) : void;
}