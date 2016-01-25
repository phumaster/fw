<?php

/*
 | Project: fw
 | Description: my framework
 | Author: Pham Ngoc Phu
 | Alias: Phu Master
 | Email: phumaster.dev@gmail.com 
 */

require_once __BASE_PATH.'/vendor/autoload.php';
require_once __SYSTEM_PATH.'/common/functions.php';

$app = (new App())->run();
