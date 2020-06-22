<?php

/**
 * ALERT: The files below should not be changed. 
 * Changing them may cause a fatal error in your project.
 */

ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();

require_once __DIR__.'/../vendor/autoload.php';

use Solital\Core\Course\Course;

define('ROOT', dirname(__DIR__));

 /**
 * The default namespace for route-callbacks, so we don't have to specify it each time.
 * Can be overwritten by using the namespace config option on your routes.
 */
Course::setDefaultNamespace('\Solital\Components\Controller');

/**
 * DON'T REMOVE OR CHANGE THE METHOD BELOW
 */
Course::verifyComponents();

Course::start();