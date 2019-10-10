<?php
spl_autoload_register('autoload');

function autoloadRun() {
    $basepath = get_include_path();
    $basepath .= PS . CLASSES .
    $activeRecord = PS . AR;
    $queryBulder = PS . QB;
    $mvc = PS . MVC;
    $api = PS . API;
    $exceptions = PS . Exceptions;
    $http = PS . HTTP;
    $models = PS . APP_PATH . '/models';
    $basepath .= $queryBulder . $mvc . $activeRecord . $api . $exceptions . $http . $models;

    set_include_path($basepath);
}

function autoload($name) {
    include $name . '.php';
}