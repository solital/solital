<?php

/**
 * ALERT: The files below should not be changed. 
 * Changing them may cause a fatal error in your project.
 */

session_start();

require_once '../vendor/autoload.php';

use Solital\Course\Course;

define('ROOT', dirname(__DIR__));

/**
 * DON'T REMOVE OR CHANGE THE METHOD BELOW
 */

Course::verifyComponents();
/**
 * The default namespace for route-callbacks, so we don't have to specify it each time.
 * Can be overwritten by using the namespace config option on your routes.
 */

Course::setDefaultNamespace('Solital\Controller');
Course::start();