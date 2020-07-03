<?php

/**
 * CONFIG CONSTANTS
 */
define('ERRORS_DISPLAY', true);

/**
 * GUARDIAN CONSTANTS
 */

define('URL_LOGIN', 'your_url_login');
define('URL_DASHBOARD', 'your_url_dashboard');
define('INDEX_LOGIN', 'solital_index_login');

/**
 * OPENSSL CONSTANTS
 */

define('SECRET_IV', pack('a16', 'first_secret'));
define('SECRET', pack('a16', 'second_secret'));

/**
 * MONOLOG DIRECTORY
 */
define('MONOLOG_DIR', dirname(__DIR__).'/app/LogFiles/');