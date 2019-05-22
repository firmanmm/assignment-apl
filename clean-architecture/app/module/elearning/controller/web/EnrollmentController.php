<?php

namespace App\Elearning\Controllers\Web;

use Phalcon\Mvc\Controller;
use App\Elearning\Controllers\Web\Presenter\EnrollmentFormPresenterImpl;
use Domain\Elearning\Interactor\EnrollmentForm;
use App\Elearning\Controllers\Web\Presenter\EnrollmentFormPostPresenter;
use Domain\Elearning\Entity\CourseEntity;
use Domain\Elearning\Entity\UserEntity;
use Domain\Elearning\Interactor\CourseEnrollment;

class EnrollmentController extends Controller {
    public function homeAction() {
        $presenter = new EnrollmentFormPresenterImpl($this->view);
        $interactor = new EnrollmentForm($this->userService, $this->courseService, $presenter);
        $interactor->showForm();
    }

    public function postAction() {
        $presenter = new EnrollmentFormPostPresenter();
        $interactor = new CourseEnrollment($this->courseService, $this->userService, $this->courseEnrollmentService, $presenter);
        $courseId = $this->request->getPost("courseId");
        $studentId = $this->request->getPost("studentId");
        $interactor->enroll($courseId, $studentId);
    }
}