<?php

require_once dirname(__DIR__). '/vendor/autoload.php';

use Solital\Core\Course\Course;
use Solital\Core\Kernel\Application;

Application::autoload("../vendor/solital/core/src/Resource/Helpers/");

Course::setDefaultNamespace('\Solital\Components\Controller');
Application::loadCsrfVerifier();

Application::autoload("../routers/");
Application::init();