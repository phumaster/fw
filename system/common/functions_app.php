<?php

/*
  | Project: fw
  | Description: my framework
  | Author: Pham Ngoc Phu
  | Alias: Phu Master
  | Email: phumaster.dev@gmail.com
 */

if (!function_exists('view')) {

    function view($view = NULL, $parameter = NULL) {
        \PM\View::make($view, $parameter);
        return new \PM\Session();
    }

}

if (!function_exists('get')) {

    function get($name = NULL) {
        return \PM\Session::get($name);
    }

}

if (!function_exists('has')) {

    function has($name = NULL) {
        if (isset($_SESSION[$name])) {
            return TRUE;
        }
        return FALSE;
    }

}

if(! function_exists('redirect')) {
  function redirect() {
    return new \PM\Redirect();
  }
}
