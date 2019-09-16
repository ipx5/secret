<?php
spl_autoload_register('autoload');

function autoloadRun() {
    $basepath = get_include_path();
    $basepath .= PATH_SEPARATOR . CLASSES .
    $activeRecord = PS . AR;
    $queryBulder = PS . QB;
    $mvc = PS . MVC;
    $api = PS . API;
    $exceptions = PS . Exceptions;
    $http = PS . HTTP;
    $basepath .= $queryBulder . $mvc . $activeRecord . $api . $exceptions . $http;

    set_include_path($basepath);
}

function autoload($name) {
    include $name . '.php';
}