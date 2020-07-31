<?php

/**
 * ALERT: The files below should not be changed. 
 * Changing them may cause a fatal error in your project.
 */

require_once __DIR__.'/../vendor/autoload.php';

use Solital\Core\Course\Course;

define('ROOT', dirname(__DIR__));

Course::setDefaultNamespace('\Solital\Components\Controller');
Course::csrfVerifier(new \Solital\Core\Http\Middleware\BaseCsrfVerifier());

foreach(glob('../routers/*.php') as $routers){
    require_once $routers;
}

Course::start();