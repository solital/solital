<?php

use Solital\Course\Course;
use Wolf\Wolf;

Course::get('/', 'Solital\Controllers\UserController@index');
Course::get('/about', 'Solital\Controllers\UserController@about');
Course::get('/contact', 'Solital\Controllers\UserController@contact');