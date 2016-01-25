<?php

/*
 | Project: fw
 | Description: my framework
 | Author: Pham Ngoc Phu
 | Alias: Phu Master
 | Email: phumaster.dev@gmail.com 
 */

/*
 *  all route
 */

Route::add('/', function() {
    echo Config::get('db')->hostname;
});
Route::add('/abc', 'UserController@action');
Route::add('/this-is-route');
Route::add('/route-2');
Route::add('/{id}');
Route::add('/route3');
