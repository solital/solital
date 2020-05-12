<?php

/**
 * ALERT: The files below should not be changed. 
 * Changing them may cause a fatal error in your project.
 */

session_start();

require_once '../vendor/autoload.php';

foreach(glob('../config/*.php') as $file){
    require_once $file;
}

use Solital\Course\Course;
use Wolf\Wolf;

/* Load external routes file */
require_once ROOT.'/helpers.php';
require_once ROOT.'/routers/routes.php';

if (VINCI_MODE === true) {
    Course::get('/vinci-mode', function(){
        Wolf::loadDevView('vinci/vinci', []);
    });   
}

if (ERRORS_DISPLAY === true) {
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
}

/**
 * The default namespace for route-callbacks, so we don't have to specify it each time.
 * Can be overwritten by using the namespace config option on your routes.
 */

Course::setDefaultNamespace('Solital\Controller');
Course::start();