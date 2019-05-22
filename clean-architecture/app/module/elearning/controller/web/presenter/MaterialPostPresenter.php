<?php 

namespace App\Elearning\Controllers\Web\Presenter;

use Domain\Elearning\Presenter\MaterialPresenter;
use Phalcon\Http\Response;
use Domain\Elearning\Entity\MaterialEntity;

class MaterialPostPresenter implements MaterialPresenter {
    public function present(MaterialEntity $materialEntity) : void
    {
        //Fallback to Home Controller ~~
    }
}