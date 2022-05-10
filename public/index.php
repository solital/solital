<?php

/**
 * WARNING: DO NOT MAKE ANY KIND OF CHANGE IN THIS FILE. 
 * ANY KIND OF MODIFICATION WILL BREAK YOUR PROJECT. 
 */

require_once dirname(__DIR__). '/vendor/autoload.php';

use Solital\Core\Course\Course;
use Solital\Core\Kernel\Application;
use Solital\Core\Http\Middleware\BaseCsrfVerifier;

define('SITE_ROOT', dirname(__DIR__));

Application::autoload("../vendor/solital/core/src/Resource/Helpers/");

Course::setDefaultNamespace('\Solital\Components\Controller');
Course::csrfVerifier(new BaseCsrfVerifier());

Application::autoload("../routers/");
Application::init();