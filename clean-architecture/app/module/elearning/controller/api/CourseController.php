<?php

namespace App\Elearning\Controllers\Api;

use Phalcon\Mvc\Controller;
use Exception;
use Domain\Elearning\Entity\CourseEntity;
use App\Elearning\Controllers\Api\Presenter\CourseListPresenterImpl;
use Domain\Elearning\Interactor\ListCourse;
use App\Elearning\Controllers\Api\Presenter\CoursePresenterImpl;
use Domain\Elearning\Interactor\ViewCourse;
use Domain\Elearning\Interactor\AddCourse;

class CourseController extends Controller {

    public function getAllAction() {
        $presenter = new CourseListPresenterImpl();
        $interactor = new ListCourse($this->courseService, $presenter);
        $interactor->listCourse();
    }

    public function getByIdAction($id) {
        $presenter = new CoursePresenterImpl();
        $interactor = new ViewCourse(
            $this->courseService, 
            $this->userService, 
            $this->enrollmentService,
            $this->materialService, 
            $this->qRService, 
            $presenter);

        $interactor->viewCourseById($id);
    }

    public function postAction() {
        $presenter = new CoursePresenterImpl();
        $interactor = new AddCourse($this->courseService, $presenter);
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
        }
        
    }
}