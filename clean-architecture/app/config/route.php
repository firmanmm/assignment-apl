<?php

$di['router'] = function() use ($defaultModule, $modules, $di, $config) {

	$router = new \Phalcon\Mvc\Router(false);
	$router->clear();

	/**
	 * Default Routing
	 */
	$router->add('/', [
	    'namespace' => $modules[$defaultModule]['webControllerNamespace'],
		'module' => $defaultModule,
	    'controller' => 'Dashboard',
	    'action' => 'hello'
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

	$router->addGet("/users", [
		'namespace' => 'App\Elearning\Controllers\Api',
		'module' => 'elearning',
		'controller' => 'user',
		'action' => 'getAll'
	]);

	$router->addGet("/users/([0-9]+)", [
		'namespace' => 'App\Elearning\Controllers\Api',
		'module' => 'elearning',
		'controller' => 'user',
		'action' => 'getById',
		'id' => 1
	]);

	$router->addPost("/users", [
		'namespace' => 'App\Elearning\Controllers\Api',
		'module' => 'elearning',
		'controller' => 'user',
		'action' => 'post'
	]);

	$router->addGet("/courses", [
		'namespace' => 'App\Elearning\Controllers\Api',
		'module' => 'elearning',
		'controller' => 'course',
		'action' => 'getAll'
	]);

	$router->addGet("/courses/([0-9]+)", [
		'namespace' => 'App\Elearning\Controllers\Api',
		'module' => 'elearning',
		'controller' => 'course',
		'action' => 'getById',
		'id' => 1
	]);

	$router->addPost("/courses", [
		'namespace' => 'App\Elearning\Controllers\Api',
		'module' => 'elearning',
		'controller' => 'course',
		'action' => 'post'
	]);

	
	
    $router->removeExtraSlashes(true);
    
	return $router;
};

?>