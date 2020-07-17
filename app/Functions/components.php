<?php

foreach(glob('../config/*.php') as $configs){
    require_once $configs;
}

if (defined('ERRORS_DISPLAY')) {    
    if (ERRORS_DISPLAY === true) {
        ini_set('display_errors', 1);
        error_reporting(E_ALL);
    }
}

foreach(glob('../routers/*.php') as $routers){
    require_once $routers;
}