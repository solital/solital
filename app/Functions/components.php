<?php

if (!session_id()) {
    if (!is_dir(dirname(__DIR__)."/Storage/")) {
        mkdir(dirname(__DIR__)."/Storage/");
    }
    
    session_save_path(dirname(__DIR__)."/Storage/");
    session_start();
}

foreach(glob('../config/*.php') as $configs){
    require_once $configs;
}

if (defined('ERRORS_DISPLAY')) {    
    if (ERRORS_DISPLAY === true) {
        ini_set('display_errors', 1);
        error_reporting(E_ALL);
    }
}