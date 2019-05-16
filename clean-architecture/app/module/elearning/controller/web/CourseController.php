<?php
namespace App\Elearning\Controllers\Web;

use Phalcon\Mvc\Controller;
use function GuzzleHttp\json_encode;
use function GuzzleHttp\json_decode;
use Domain\Elearning\Entity\UserEntity;
use Domain\Elearning\Service\CourseService;
use Domain\Elearning\Entity\CourseEntity;
use Domain\Elearning\Service\MaterialService;

class CourseController extends Controller {
    public function homeAction() {
        /**
         * @var CourseService $courseService
         */
        $courseService = $this->courseService;
        $raw = json_encode($courseService->getAllCourse());
        $decoded = json_decode($raw);
        $this->view->setVar("courses", $decoded);
        $this->view->pick('course/home');
    }

    public function postAction() {
        /**
         * @var CourseService $courseService
         */
        $courseService = $this->courseService;
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
        } catch (Exception $e) {
            $this->response->setStatusCode(500);
            $this->response->setJsonContent(["error" => $e->getMessage()]);
            $this->response->send();
            die();
        }
        $this->homeAction();
    }

    public function detailAction($id) {
        /**
         * @var CourseService $courseService
         */
        $courseService = $this->courseService;
        $courses = $courseService->getUsersByCourseId($id);
        $raw = json_encode($this->userService->getAllUser());
        $decoded = json_decode($raw);
        $this->view->setVar("studentList", $decoded);
        $raw = json_encode($courses);
        $decoded = json_decode($raw);
        $this->view->setVar("students", $decoded);
        $raw = json_encode($courseService->getCourseById($id));
        $decoded = json_decode($raw);
        $this->view->setVar("course", $decoded);
        /**
         * @var MaterialService $materialService
         */
        $materialService = $this->materialService;
        $raw = json_encode($materialService->getAllMaterialByCourseId($id));
        $decoded = json_decode($raw);
        $this->view->setVar("materials", $decoded);
        $this->view->setVar("qrCode", $courseService->generateQR("http://localhost:8081/course/".$id));
        $this->view->pick('course/detail');
    }

    public function addStudentAction($id) {
        /**
         * @var CourseService $courseService
         */
        $courseService = $this->courseService;
        $studentId = $this->request->getPost('studentId');
        $courseService->enrollUser($id,$studentId);
        $this->detailAction($id);
    }
}