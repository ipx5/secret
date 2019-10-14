<?php


define('DEBUG', 1);
if (DEBUG) {
    ini_set('display_errors', 1);
    //ini_set('memory_limit', '-1');
    error_reporting(E_ALL);
}

header("Access-Control-Allow-Origin: http://localhost:4200");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
//header('Content-Type: application/json; charset=UTF-8');
header("Access-Control-Allow-Credentials", "true");
header("Access-Control-Allow-Headers", "*");


$config = include './config.php';
include './framework/Core.php';
include './framework/classes/Autoload.php';
app::getInstance()->start($config);
