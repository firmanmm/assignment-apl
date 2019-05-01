<?php

use Phalcon\Mvc\Application;
use Phalcon\Debug;
use Phalcon\DI\FactoryDefault;
use Dotenv\Dotenv;
require __DIR__ . '../../vendor/autoload.php';

class Bootstrap extends Application
{
	private $modules;
	private $defaultModule;

	public function __construct($defaultModule)
	{
		parent::__construct();
		$this->modules = require APP_PATH . '/config/module.php';
		$this->defaultModule= $defaultModule;
		$dotenv = Dotenv::create(__DIR__);
		$dotenv->load();
	}

	public function init()
	{
		$this->_registerServices();

		$config = $this->getDI()['config'];

		if ($config->mode == 'DEVELOPMENT') {
			$debug = new Debug();
			$debug->listen();
		}
		
		/**
		 * Load modules
		 */
		$this->registerModules($this->modules);

		echo $this->handle()->getContent();
	}

	private function _registerServices()
	{
		$defaultModule = $this->defaultModule;

		$di = new FactoryDefault();
		$config = require APP_PATH . '/config/config.php';
		$modules = $this->modules;

		include_once APP_PATH . '/config/constant.php';
		include_once APP_PATH . '/config/loader.php';
		include_once APP_PATH . '/config/service.php';
		include_once APP_PATH . '/config/route.php';

		$this->setDI($di);
	}
}