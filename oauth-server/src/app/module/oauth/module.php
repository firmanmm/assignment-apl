<?php

namespace App\Oauth;

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

        $loader->registerNamespaces([
            'App\Oauth\Controllers\Web' => __DIR__ . '/controller/web',
            'App\Oauth\Controllers\Api' => __DIR__ . '/controller/api',
            'App\Oauth\Models' => __DIR__ . '/model',
            'App\Oauth\Base' => __DIR__.'/base',
            'App\Oauth\Implementation' => __DIR__.'/implementation',
            'App\Oauth\Implementation\Adapter' => __DIR__.'/implementation/adapter',
            'App\Oauth\Implementation\League' => __DIR__.'/implementation/league',
            'App\Oauth\Implementation\BShaffer' => __DIR__.'/implementation/bshaffer', 
            'App\Oauth\Implementation\League\Entity' => __DIR__.'/implementation/league/entity',
            'App\Oauth\Implementation\League\Repository' => __DIR__.'/implementation/league/repository',
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