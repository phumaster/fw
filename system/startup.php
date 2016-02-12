<?php

/*
  | Project: fw
  | Description: my framework
  | Author: Pham Ngoc Phu
  | Alias: Phu Master
  | Email: phumaster.dev@gmail.com
 */

session_start();

require __BASE_PATH . '/vendor/autoload.php';
require __SYSTEM_PATH . '/common/functions.php';

$app = (new App())->run();
