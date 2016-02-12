<?php

/*
 | Project: fw
 | Description: my framework
 | Author: Pham Ngoc Phu
 | Alias: Phu Master
 | Email: phumaster.dev@gmail.com 
 */

if(!function_exists('view')) {
    function view($view = NULL, $parameter = NULL) {
        \PM\View::make($view, $parameter);
        return new \PM\Session();
    }
}