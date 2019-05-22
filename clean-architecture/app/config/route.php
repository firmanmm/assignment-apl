<?php

$di['router'] = function() use ($defaultModule, $modules, $di, $config) {

	$router = new \Phalcon\Mvc\Router(false);
	$router->clear();

	/**
	 * Default Routing
	 */
	$router->add('/', [
	    'namespace' => 'App\Elearning\Controllers\Web',
		'module' => 'elearning',
	    'controller' => 'Dashboard',
	    'action' => 'welcome'
	]);
	
	/**
	 * Not Found Routing
	 */
	$router->notFound(
		[
			'namespace' => 'App\Common\Controllers',
			'controller' => 'base',
			'action'     => 'route404',
		]
	);

	$router->addGet("/course/([0-9]+)/migrate", [
		'namespace' => 'App\Elearning\Controllers\Web',
		'module' => 'elearning',
		'controller' => 'migrate',
		'action' => 'home',
		'id' => 1
	]);

	$router->addPost("/course/([0-9]+)/migrate", [
		'namespace' => 'App\Elearning\Controllers\Web',
		'module' => 'elearning',
		'controller' => 'migrate',
		'action' => 'post',
		'id' => 1
	]);

	$router->addGet("/enrollment", [
		'namespace' => 'App\Elearning\Controllers\Web',
		'module' => 'elearning',
		'controller' => 'enrollment',
		'action' => 'home'
	]);

	$router->addPost("/enrollment", [
		'namespace' => 'App\Elearning\Controllers\Web',
		'module' => 'elearning',
		'controller' => 'enrollment',
		'action' => 'post'
	]);

	$router->addGet("/student", [
		'namespace' => 'App\Elearning\Controllers\Web',
		'module' => 'elearning',
		'controller' => 'user',
		'action' => 'home'
	]);

	$router->addPost("/student", [
		'namespace' => 'App\Elearning\Controllers\Web',
		'module' => 'elearning',
		'controller' => 'user',
		'action' => 'post'
	]);

	$router->addGet("/material", [
		'namespace' => 'App\Elearning\Controllers\Web',
		'module' => 'elearning',
		'controller' => 'material',
		'action' => 'home'
	]);

	$router->addPost("/material", [
		'namespace' => 'App\Elearning\Controllers\Web',
		'module' => 'elearning',
		'controller' => 'material',
		'action' => 'post'
	]);

	$router->addGet("/course", [
		'namespace' => 'App\Elearning\Controllers\Web',
		'module' => 'elearning',
		'controller' => 'course',
		'action' => 'home'
	]);

	$router->addPost("/course", [
		'namespace' => 'App\Elearning\Controllers\Web',
		'module' => 'elearning',
		'controller' => 'course',
		'action' => 'post'
	]);

	$router->addGet("/course/([0-9]+)", [
		'namespace' => 'App\Elearning\Controllers\Web',
		'module' => 'elearning',
		'controller' => 'course',
		'action' => 'detail',
		'id' => 1
	]);

	$router->addPost("/course/([0-9]+)", [
		'namespace' => 'App\Elearning\Controllers\Web',
		'module' => 'elearning',
		'controller' => 'course',
		'action' => 'addStudent',
		'id' => 1
	]);

	$router->addGet("/api/users", [
		'namespace' => 'App\Elearning\Controllers\Api',
		'module' => 'elearning',
		'controller' => 'user',
		'action' => 'getAll'
	]);

	$router->addGet("/api/users/([0-9]+)", [
		'namespace' => 'App\Elearning\Controllers\Api',
		'module' => 'elearning',
		'controller' => 'user',
		'action' => 'getById',
		'id' => 1
	]);

	$router->addPost("/api/users", [
		'namespace' => 'App\Elearning\Controllers\Api',
		'module' => 'elearning',
		'controller' => 'user',
		'action' => 'post'
	]);

	$router->addGet("/api/courses", [
		'namespace' => 'App\Elearning\Controllers\Api',
		'module' => 'elearning',
		'controller' => 'course',
		'action' => 'getAll'
	]);

	$router->addGet("/api/courses/([0-9]+)", [
		'namespace' => 'App\Elearning\Controllers\Api',
		'module' => 'elearning',
		'controller' => 'course',
		'action' => 'getById',
		'id' => 1
	]);

	$router->addPost("/api/courses", [
		'namespace' => 'App\Elearning\Controllers\Api',
		'module' => 'elearning',
		'controller' => 'course',
		'action' => 'post'
	]);

	
	
    $router->removeExtraSlashes(true);
    
	return $router;
};

?>