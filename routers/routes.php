<?php

use Solital\Core\Wolf\Wolf;
use Solital\Core\Course\Course;

Course::get('/', function () {
    Wolf::loadView('welcome');
});
