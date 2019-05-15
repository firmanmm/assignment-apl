<?php

use Phalcon\Logger\Adapter\File as Logger;
use Phalcon\Session\Adapter\Files as Session;
use Phalcon\Http\Response\Cookies;
use Phalcon\Security;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\View;
use Phalcon\DiInterface;
use Phalcon\Flash\Direct as FlashDirect;
use Phalcon\Flash\Session as FlashSession;
use Domain\Elearning\Service\UserService;
use Domain\Elearning\Service\CourseService;
use App\Elearning\Repository\UserRepository;
use App\Elearning\Repository\CourseRepository;
use App\Elearning\Repository\MaterialRepository;
use Domain\Elearning\Service\MaterialService;
use App\Elearning\Repository\UserCourseRepository;

$di['config'] = function() use ($config) {
	return $config;
};

$di["database"] = function () use ($config) {
    return new Phalcon\Db\Adapter\Pdo\MySQL((array)($config->database));
};

$di['session'] = function() {
    $session = new Session();
	$session->start();

	return $session;
};

$di['dispatcher'] = function() use ($di, $defaultModule) {

    $eventsManager = $di->getShared('eventsManager');
    $dispatcher = new Dispatcher();
    $dispatcher->setEventsManager($eventsManager);

    return $dispatcher;
};

$di['url'] = function() use ($config, $di) {
	$url = new \Phalcon\Mvc\Url();

    $url->setBaseUri($config->url['baseUrl']);

	return $url;
};

$di['userRepository'] = function() use ($di) {
    return new UserRepository($di);
};

$di['courseRepository'] = function() use ($di) {
    return new CourseRepository($di);
};

$di['materialRepository'] = function() use ($di) {
    return new MaterialRepository($di);
};

$di['userCourseRepository'] = function() use ($di) {
    return new UserCourseRepository($di);
};


$di['userService'] = function() use ($di) {
    return new UserService($di['userRepository']);
};

$di['materialService'] = function() use ($di) {
    return new MaterialService($di['materialRepository']);
};

$di['courseService'] = function() use ($di) {
    return new CourseService($di['courseRepository'], $di['userCourseRepository'], $di['userService']);
};

$di['voltService'] = function($view, $di) use ($config) {
    $volt = new \Phalcon\Mvc\View\Engine\Volt($view, $di);
    if (!is_dir($config->application->cacheDir)) {
        mkdir($config->application->cacheDir);
    }

    $compileAlways = $config->mode == 'DEVELOPMENT' ? true : false;

    $volt->setOptions(array(
        "compiledPath" => $config->application->cacheDir,
        "compiledExtension" => ".compiled",
        "compileAlways" => $compileAlways
    ));
    return $volt;
};

$di->set(
    'security',
    function () {
        $security = new Security();
        $security->setWorkFactor(12);

        return $security;
    },
    true
);

$di->set(
    'flash',
    function () {
        $flash = new FlashDirect(
            [
                'error'   => 'alert alert-danger',
                'success' => 'alert alert-success',
                'notice'  => 'alert alert-info',
                'warning' => 'alert alert-warning',
            ]
        );

        return $flash;
    }
);

$di->set(
    'flashSession',
    function () {
        $flash = new FlashSession(
            [
                'error'   => 'alert alert-danger',
                'success' => 'alert alert-success',
                'notice'  => 'alert alert-info',
                'warning' => 'alert alert-warning',
            ]
        );

        $flash->setAutoescape(false);
        
        return $flash;
    }
);
?>