<?php

namespace App\Elearning\Controllers\Web\Presenter;

use Domain\Elearning\Presenter\MaterialListPresenter;
use Phalcon\Mvc\View;

class MaterialListPresenterImpl implements MaterialListPresenter {
    private $view;

    public function __construct(View $view)
    {
        $this->view = $view;
    }

    public function present(array $materialList, array $courseList ): void
    {
        $this->view->setVar('courses', $this->makeCourses($courseList));
        $this->view->setVar('materials', $this->makeMaterial($materialList));
        $this->view->pick('material/home');
    }

    private function makeCourses(array $courseList) : array {
        $res = [];
        foreach($courseList as $data) {
            $res[] = $data->jsonSerialize();
        }
        return $res;
    }

    private function makeMaterial(array $materialList) : array {
        $materials = [];
        foreach($materialList as $material) {
            $materials[] = $material->jsonSerialize();
        }
        return $materials;
    }
}