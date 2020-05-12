<?php

use Solital\Course\Course;
use Wolf\Wolf;

Course::get('/', function(){
    Wolf::loadView('welcome', [], false);
});
Course::get('/home', 'Solital\Controller\UserController@home');
Course::get('/about', 'Solital\Controller\UserController@about');
Course::get('/login', 'Solital\Controller\UserController@login');
Course::get('/sair', 'Solital\Controller\UserController@logoff');
Course::post('/verificar-login', 'Solital\Controller\UserController@verificar');