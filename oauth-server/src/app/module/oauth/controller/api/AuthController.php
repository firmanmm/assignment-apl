<?php

namespace App\Oauth\Controllers\Api;

use App\Oauth\Implementation\Adapter\ServerAdapterInterface;
use Phalcon\Mvc\Controller;
use Phalcon\DiInterface;

class AuthController extends Controller {

    public function codeAction() {
        echo $_GET["code"];
    }

    public function authorizeAction() {
        return $this->oauth->authorize();
    }

    public function tokenAction() {
        return $this->oauth->token();
    }
}