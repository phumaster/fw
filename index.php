<?php

/*
 | Project: fw
 | Description: my framework
 | Author: Pham Ngoc Phu
 | Alias: Phu Master
 | Email: phumaster.dev@gmail.com 
 */

define('__APPSTART__', true);

define('__APP_PATH', $_SERVER['DOCUMENT_ROOT'].'/app');

define('__BASE_PATH', $_SERVER['DOCUMENT_ROOT']);

define('__SYSTEM_PATH', $_SERVER['DOCUMENT_ROOT'].'/system');

/*
 *  start application
 */

require_once __DIR__.'/system/startup.php';
