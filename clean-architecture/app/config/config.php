<?php

use Phalcon\Config;

return new Config(
    [
        'mode' => 'DEVELOPMENT', //DEVELOPMENT, PRODUCTION, DEMO

        'database' => [
            'host' => getenv("DB_HOST"),
            'username' => getenv("DB_USERNAME"),
            'password' => getenv("DB_PASSWORD"),
            'dbname' => getenv("DB_NAME")
        ],   
        
        'url' => [
            'baseUrl' => 'http://localhost:8081/',
        ],
        
        'application' => [
            'libraryDir' => APP_PATH . "/lib/",
            'cacheDir' => APP_PATH . "/cache/",
        ],

        'version' => '0.1',
    ]
);

?>