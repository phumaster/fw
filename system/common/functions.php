<?php

/*
  | Project: fw
  | Description: my framework
  | Author: Pham Ngoc Phu
  | Alias: Phu Master
  | Email: phumaster.dev@gmail.com
 */


spl_autoload_register(function ($class) {
    $class_load = __SYSTEM_PATH . '/classes/' . $class . '.php';
    if (file_exists($class_load)) {
        require_once $class_load;
    }
    return false;
});

if (!function_exists('getNamespace')) {

    function getNamespace($name) {
        $namespace = null;
        $file = fopen($name, 'r');

        if ($file) {
            while (($line = fgets($file)) != false) {
                if (strpos($line, 'namespace') === 0) {
                    $parts = explode(' ', $line);
                    $namespace = rtrim(trim($parts[1]), ';');
                    break;
                }
            }
            fclose($file);
        }

        return $namespace;
    }

}