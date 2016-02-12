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

Route::add('/', 'WelcomeController@hello');

Route::add('/{name}', function ($name) {
    return view('welcome', compact('name'));
});