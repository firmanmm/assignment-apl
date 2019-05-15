<?php
namespace App\Elearning\Controllers\Web;

use Phalcon\Mvc\Controller;

class DashboardController extends Controller {
    public function welcomeAction() {
        $this->view->pick('login');
    }
}