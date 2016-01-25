<?php

/*
  | Project: fw
  | Description: my framework
  | Author: Pham Ngoc Phu
  | Alias: Phu Master
  | Email: phumaster.dev@gmail.com
 */

class Config {

    private static $config = [];
    private static $config_path = __BASE_PATH . '/config';

    private static function load($filename) {
        $config = self::$config_path . '/' . $filename . '.php';
        if (file_exists($config)) {
            self::$config = require_once $config;
        }
    }
    
    public static function get($name) {
        self::load($name);
        return (object)self::$config;
    }

}
