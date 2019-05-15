<?php

namespace App\Elearning\Controllers\Api;

use Phalcon\Mvc\Controller;
use Exception;
use Domain\Elearning\Entity\CourseEntity;

class CourseController extends Controller {

    public function getAllAction() {
        $courseService = $this->courseService;
        $this->response->setJsonContent($courseService->getAllCourse());
        $this->response->send();
    }

    public function getByIdAction($id) {
        $courseService = $this->courseService;
        $course = $courseService->getCourseById($id);
        if($course == null) {
            $this->response->setStatusCode(404);
        }
        $this->response->setJsonContent($course);
        $this->response->send();
    }

    public function postAction() {
        $name = $this->request->getPost('name');
        $courseId = $this->request->getPost('courseId');
        $description = $this->request->getPost('description');
        $capacity = $this->request->getPost('capacity');
        try{
            $course = new CourseEntity(0);
            $course->setName($name);
            $course->setCourseId($courseId);
            $course->setDescription($description);
            $course->setCapacity($capacity);
            $courseService = $this->courseService;
            $courseService->saveCourse($course);
            $this->response->setJsonContent($course);
            $this->response->send();
        } catch (Exception $e) {
            $this->response->setStatusCode(500);
            $this->response->setJsonContent(["error" => $e->getMessage()]);
            $this->response->send();
        }
        
    }
}