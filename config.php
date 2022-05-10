<?php

require_once __DIR__ .'/vendor/autoload.php';

use Solital\Core\Kernel\Application;

Application::sessionInit();

$dotenv = Dotenv\Dotenv::createUnsafeImmutable(__DIR__);
$dotenv->load();

if (!empty(getenv('ERRORS_DISPLAY'))) {
    if (getenv('ERRORS_DISPLAY') == 'true') {
        ini_set('display_errors', 1);
        error_reporting(E_ALL);
    }
}