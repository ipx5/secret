<?php

define('DS', DIRECTORY_SEPARATOR);
define('BASE_PATH', __DIR__ .DS);
define('APP_PATH', BASE_PATH . 'application' . DS);
define('CLASSES', BASE_PATH . 'framework' . DS . 'classes' . DS);
define('IMG', APP_PATH . 'views' . DS .  'img' . DS);

return [
    'paths'=> [
        'controllers'=> APP_PATH . 'controllers' . DS,
        'models' => APP_PATH . 'models' . DS,
        'views' => APP_PATH . 'views' . DS,
        'layout' => APP_PATH . 'views' . DS . 'layout' . DS,
        'template' => APP_PATH . 'views' . DS . 'template' . DS
    ],
    'db' => [
        'local' => [
            'host' => 'localhost',
            'port' => 5432,
            'dbname' => 'zhuravlev',
            'user' => 'zhuravlev',
            'password' => 'zhuravlev'
        ]
    ]
];
