<?php

#require_once '../config/config.php';
#require_once '../config/db.php';

function includes(){
    foreach(glob('../config/*.php') as $arquivo){
        require_once $arquivo;
    }
}

includes();

require_once '../vendor/autoload.php';

use Solital\Course\Course;
use Solital\Guardian\Guardian;

/* Load external routes file */
require_once '../routers/routes.php';

if (DEV_MODE === true) {
    Course::get('/dev-mode', 'Solital\Controllers\DevModeController@index');   
}

if (ERRORS_DISPLAY === true) {
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
}

if (GUARDIAN_MAIL_SEND === true) {
    Guardian::send();
}

/**
 * The default namespace for route-callbacks, so we don't have to specify it each time.
 * Can be overwritten by using the namespace config option on your routes.
 */

Course::setDefaultNamespace('Pecee\Controllers');
Course::start();