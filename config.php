<?php

define('SITE_ROOT', __DIR__);

require_once 'vendor/autoload.php';

use Solital\Core\Kernel\{Application, Dotenv};

Dotenv::env(__DIR__);
Application::sessionInit();