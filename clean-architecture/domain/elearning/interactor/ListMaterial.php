<?php

namespace Domain\Elearning\Interactor;

use Domain\Elearning\Service\MaterialService;
use Domain\Elearning\Presenter\MaterialListPresenter;

class ListMaterial {
    private $materialService;
    private $presenter;

    public function __construct(MaterialService $materialService, MaterialListPresenter $presenter)
    {
        $this->materialService = $materialService;
        $this->presenter = $presenter;
    }

    public function listMaterial() : void {
        $materialList = $this->materialService->getAllMaterial();
        $this->presenter->present($materialList);
    }
}