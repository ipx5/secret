<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
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
