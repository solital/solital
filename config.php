<?php

define('SITE_ROOT', __DIR__);

require_once 'vendor/autoload.php';

use Solital\Core\Kernel\Application;
use Solital\Core\Kernel\Dotenv;

Application::sessionInit();
Dotenv::env(__DIR__);

if (!empty(getenv('ERRORS_DISPLAY'))) {
    if (getenv('ERRORS_DISPLAY') == 'true') {
        ini_set('display_errors', 1);
        error_reporting(E_ALL);
    }
}
