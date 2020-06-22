<?php

use Solital\Core\Course\Course;
use Solital\Core\Wolf\Wolf;

Course::get('/', function(){
    Wolf::loadView('welcome');
});

Course::group(['prefix' => '/admin'], function () {
    Course::controller('/user', UserController::class, ['as' => 'usuario'])->name('user');
    Course::get('/func', 'UserController@func')->name('func');
    Course::get('/login', 'UserController@login')->name('login');
});