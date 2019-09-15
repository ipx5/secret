<?php

define('DEBUG', 1);
if (DEBUG) {
    ini_set('display_errors', 1);
    //ini_set('memory_limit', '-1');
    error_reporting(E_ALL);
}

$config = include './config.php';
include './framework/Core.php';
include './framework/classes/Autoload.php';
app::getInstance()->start($config);
