<?php

require_once 'vendor/autoload.php';
require_once 'app/Helpers/helpers-custom.php';

$session_dir = __DIR__ . DIRECTORY_SEPARATOR . "app" . DIRECTORY_SEPARATOR . "Storage" . DIRECTORY_SEPARATOR . "session" . DIRECTORY_SEPARATOR;

if (!session_id()) {
    if (!is_dir($session_dir)) {
        \mkdir($session_dir);
    }

    session_save_path($session_dir);
    session_start();
}

$dotenv = Dotenv\Dotenv::createUnsafeImmutable(__DIR__);
$dotenv->load();

if (!empty($_ENV['ERRORS_DISPLAY'])) {
    if ($_ENV['ERRORS_DISPLAY'] == 'true') {
        ini_set('display_errors', 1);
        error_reporting(E_ALL);
    }
}