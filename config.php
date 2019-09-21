<?php

define('DS', DIRECTORY_SEPARATOR);
define('BASE_PATH', __DIR__ .DS);
define('PS', PATH_SEPARATOR);
define('APP_PATH', BASE_PATH . 'application' . DS);
define('CLASSES', BASE_PATH . 'framework' . DS . 'classes');
define('IMG', APP_PATH . 'views' . DS .  'img' . DS);
define('QB', CLASSES . DS . 'QueryBuilder');
define('AR', CLASSES . DS . 'ActiveRecord');
define('Exceptions', CLASSES . DS . 'Exceptions');
define('MVC', CLASSES . DS . 'MVC');
define('API', BASE_PATH . 'framework' . DS . 'API');
define('HTTP', CLASSES . DS . 'Http');
define('CONTROLLERS', APP_PATH . 'controllers');

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
            'dbname' => 'secret',
            'user' => 'hackeru',
            'password' => 'HackerUwd2'
        ]
    ],
];
