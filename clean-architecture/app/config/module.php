<?php

return array(
 
    'elearning' => [
        'namespace' => 'App\Elearning',
        'webControllerNamespace' => 'App\Elearning\Controllers\Web',
        'apiControllerNamespace' => 'App\Elearning\Controllers\Api',
        'className' => 'App\Elearning\Module',
        'path' => APP_PATH . '/module/elearning/module.php',
        'defaultRouting' => true,
        'defaultController' => 'dashboard',
        'defaultAction' => 'index'
    ],
);

?>