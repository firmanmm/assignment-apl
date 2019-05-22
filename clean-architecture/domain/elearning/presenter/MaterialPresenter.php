<?php

namespace Domain\Elearning\Presenter;

use Domain\Elearning\Entity\MaterialEntity;

interface MaterialPresenter {
    public function present(MaterialEntity $materialEntity) : void;
}