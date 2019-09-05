<?php

define('DS', DIRECTORY_SEPARATOR);
define('BASE_PATH', __DIR__ .DS);
define('APP_PATH', BASE_PATH . 'application' . DS);
define('CLASSES', BASE_PATH . 'framework' . DS . 'classes' . DS);
define('IMG', APP_PATH . 'views' . DS .  'img' . DS);
define('QB', BASE_PATH . 'framework' . DS . 'classes' . DS . 'queryBuilder');

return [
    'paths'=> [
        'controllers'=> APP_PATH . 'controllers' . DS,
        'models' => APP_PATH . 'models' . DS,
        'views' => APP_PATH . 'views' . DS,
        'layouts' => APP_PATH . 'views' . DS . 'layouts' . DS,
        'template' => APP_PATH . 'views' . DS . 'template' . DS
    ],
    'db' => [
        'local' => [
            'host' => '194.87.102.4',
            'port' => 5432,
            'dbname' => 'hackeru',
            'user' => 'hackeru',
            'password' => 'HackerUwd2'
        ]
    ]
];
