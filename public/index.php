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

Course::setDefaultNamespace('\Solital\Components\Controller');
Course::loadComponents();
Course::start();