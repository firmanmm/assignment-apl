<?php

namespace Domain\Elearning\Presenter;

use Domain\Elearning\Entity\MaterialEntity;

interface MaterialListPresenter {
    /**
     * Present
     *
     * @param MaterialEntity[]
     * @return void
     */
    public function present(array $materialList) : void;
}