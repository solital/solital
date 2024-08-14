<?php

define('SITE_ROOT', __DIR__);

require_once 'vendor/autoload.php';

use Solital\Core\Kernel\{Application, Dotenv};

Application::sessionInit();
Dotenv::env(__DIR__);