<?php

namespace App\Elearning\Controllers\Web;

use Phalcon\Mvc\Controller;
use App\Elearning\Controllers\Web\Presenter\MigrateMaterialFormPresenterImpl;
use Domain\Elearning\Interactor\MigrateMaterialForm;
use App\Elearning\Controllers\Web\Presenter\MigratePostPresenterImpl;
use Domain\Elearning\Interactor\MigrateMaterial;

class MigrateController extends Controller {
    public function homeAction($id) {
        $presenter = new MigrateMaterialFormPresenterImpl($this->view);
        $interactor = new MigrateMaterialForm($this->courseService,$this->materialService,$presenter);
        $interactor->showForm($id);
    }

    public function postAction($id) {
        $presenter = new MigratePostPresenterImpl();
        $interactor = new MigrateMaterial($this->courseService,$this->courseMaterialService, $presenter);
        $destinationId = $this->request->getPost("courseId");
        $materials = $this->request->getPost("materials");
        $interactor->migrateMaterial($id, $destinationId, $materials);
    }
}