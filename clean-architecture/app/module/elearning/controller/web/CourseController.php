<?php
namespace App\Elearning\Controllers\Web;

use Phalcon\Mvc\Controller;
use function GuzzleHttp\json_encode;
use function GuzzleHttp\json_decode;
use Domain\Elearning\Service\CourseService;
use Domain\Elearning\Entity\CourseEntity;
use Domain\Elearning\Service\MaterialService;
use App\Elearning\Controllers\Web\Presenter\CourseListPresenterImpl;
use Domain\Elearning\Interactor\ListCourse;
use App\Elearning\Controllers\Web\Presenter\CoursePresenterImpl;
use Domain\Elearning\Interactor\ViewCourse;
use Domain\Elearning\Interactor\AddCourse;

class CourseController extends Controller {
    public function homeAction() {
        $presenter = new CourseListPresenterImpl($this->view);
        $interactor = new ListCourse($this->courseService, $presenter);
        $interactor->listCourse();
    }   

    public function postAction() {

        $presenter = new CoursePresenterImpl($this->view, $this->qRService);
        $interactor = new AddCourse($this->courseService,$presenter);
        $name = $this->request->getPost('name');
        $courseId = $this->request->getPost('courseId');
        $description = $this->request->getPost('description');
        $capacity = $this->request->getPost('capacity');
        try{
            $interactor->addCourse($courseId,$name,$description,$capacity);
        } catch (Exception $e) {
            $this->response->setStatusCode(500);
            $this->response->setJsonContent(["error" => $e->getMessage()]);
            $this->response->send();
            die();
        }
        $this->homeAction();
    }

    public function detailAction($id) {
        $presenter = new CoursePresenterImpl($this->view, $this->qRService);
        $interactor = new ViewCourse(
            $this->courseService,
            $this->userService,
            $this->enrollmentService,
            $this->materialService,
            $this->qRService,
            $presenter
        );
        $interactor->viewCourseById($id);
    }
}