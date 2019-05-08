<?php

namespace App\Elearning;

use Phalcon\DiInterface;
use Phalcon\Loader;
use Phalcon\Mvc\ModuleDefinitionInterface;
use Phalcon\Mvc\View;
use Phalcon\Mvc\View\Engine\Volt;

class Module implements ModuleDefinitionInterface
{
    public function registerAutoloaders(DiInterface $di = null)
    {
        $loader = new Loader();
        $baseElearning = '/../../../domain/elearning';

        $loader->registerNamespaces([
            'App\Elearning\Controllers\Web' => __DIR__ . '/controller/web',
            'App\Elearning\Controllers\Api' => __DIR__ . '/controller/api',
            'App\Elearning\Repository' => __DIR__ . '/repository',
            'Domain\Elearning' => __DIR__ . $baseElearning,
            'Domain\Elearning\Entity' => __DIR__.$baseElearning.'/entity',
            'Domain\Elearning\Service' => __DIR__.$baseElearning.'/service',
            'Domain\Elearning\Repository' => __DIR__.$baseElearning.'/repository',
        ]);

        $loader->register();
    }

    public function registerServices(DiInterface $di = null)
    {
        $di['view'] = function () {
            $view = new View();
            $view->setViewsDir(__DIR__ . '/view/');

            $view->registerEngines(
                [
                    ".volt" => "voltService",
                ]
            );

            return $view;
        };
    }
}
?>