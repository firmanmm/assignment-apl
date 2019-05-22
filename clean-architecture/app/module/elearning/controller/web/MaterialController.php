<?php
namespace App\Elearning\Controllers\Web;

use Phalcon\Mvc\Controller;
use Domain\Elearning\Interactor\ListMaterial;
use App\Elearning\Controllers\Web\Presenter\MaterialListPresenterImpl;
use App\Elearning\Controllers\Web\Presenter\MaterialPostPresenter;
use Domain\Elearning\Interactor\AddMaterial;
use Domain\Elearning\Entity\CourseEntity;

class MaterialController extends Controller {
    public function homeAction() { 
        $presenter = new MaterialListPresenterImpl($this->view);
        $interactor = new ListMaterial($this->materialService, $this->courseService, $presenter);
        $interactor->listMaterial();
    }

    public function postAction() {
        $presenter = new MaterialPostPresenter();
        $interactor = new AddMaterial($this->courseMaterialService, $presenter);
        $courseId = $this->request->getPost('courseId');
        $title = $this->request->getPost('title');
        $description = $this->request->getPost('description');
        try{
           $interactor->addMaterial(new CourseEntity($courseId), $title, $description);
        } catch (Exception $e) {
            $this->response->setStatusCode(500);
            $this->response->setJsonContent(["error" => $e->getMessage()]);
            $this->response->send();
            die();
        }
        $this->homeAction();
    }
}