<?php

/**
 * WARNING: DO NOT MAKE ANY KIND OF CHANGE IN THIS FILE. 
 * ANY KIND OF MODIFICATION WILL BREAK YOUR PROJECT. 
 */

require_once dirname(__DIR__). '/vendor/autoload.php';

use Solital\Core\Course\Course;

define('SITE_ROOT', dirname(__DIR__));

foreach (glob('../app/Helpers/System/*.php') as $helpers) {
    require_once $helpers;
}

Course::setDefaultNamespace('\Solital\Components\Controller');
Course::csrfVerifier(new \Solital\Core\Http\Middleware\BaseCsrfVerifier());

foreach (glob('../routers/*.php') as $routers) {
    require_once $routers;
}

Course::start();
