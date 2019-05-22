<?php

namespace App\Elearning\Controllers\Web\Presenter;

use Domain\Elearning\Presenter\UserPresenter;
use Domain\Elearning\Entity\UserEntity;
use Phalcon\Http\Response;

class UserPostPresenterImpl implements UserPresenter{

    public function present(UserEntity $user): void
    {
        //Fallback to home
    }
}