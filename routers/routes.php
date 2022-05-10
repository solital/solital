<?php

use Solital\Core\Course\Course;

Course::get('/', function () {
    return view('welcome');
});