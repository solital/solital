<?php

use Solital\Course\Course;
use Solital\Wolf\Wolf;

Course::get('/', function(){
    Wolf::loadView('welcome');
});