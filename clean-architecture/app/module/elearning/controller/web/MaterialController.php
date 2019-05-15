<?php
namespace App\Elearning\Controllers\Web;

use Phalcon\Mvc\Controller;
use function GuzzleHttp\json_encode;
use function GuzzleHttp\json_decode;
use Domain\Elearning\Service\MaterialService;
use Domain\Elearning\Entity\MaterialEntity;
use Domain\Elearning\Service\CourseService;

class MaterialController extends Controller {
    public function homeAction() {
        /**
         * @var MaterialService $materialService
         */
        $materialService = $this->materialService;
        /**
         * @var CourseService $courseService
         */
        $courseService = $this->courseService;
        $raw = json_encode($materialService->getAllmaterial());
        $decoded = json_decode($raw);
        $this->view->setVar("materials", $decoded);
        $raw = json_encode($courseService->getAllCourse());
        $decoded = json_decode($raw);
        $this->view->setVar("courses", $decoded);
        $this->view->pick('material/home');
    }

    public function postAction() {
        /**
         * @var MaterialService $materialService
         */
        $materialService = $this->materialService;
        $courseId = $this->request->getPost('courseId');
        $title = $this->request->getPost('title');
        $description = $this->request->getPost('description');
        try{
            $material = new MaterialEntity(0);
            $material->setTitle($title);
            $material->setDescription($description);
            $material->setCourseId($courseId);
            $materialService = $this->materialService;
            $materialService->saveMaterial($material);
        } catch (Exception $e) {
            $this->response->setStatusCode(500);
            $this->response->setJsonContent(["error" => $e->getMessage()]);
            $this->response->send();
            die();
        }
        $this->homeAction();
    }
}