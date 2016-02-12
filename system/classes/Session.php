<?php

/*
  | Project: fw
  | Description: my framework
  | Author: Pham Ngoc Phu
  | Alias: Phu Master
  | Email: phumaster.dev@gmail.com
 */

namespace PM;

class Session {

    public static function put($session = []) {
        foreach ($session as $name => $value) {
            $_SESSION[$name] = $value;
        }
    }

    public static function delete($name = NULL) {
        session_unset($name);
    }

    public static function get($name = NULL) {
        if (!isset($name)) {
            return;
        }
        return $_SESSION[$name];
    }

    public static function flash($session = []) {
        foreach ($session as $name => $value) {
            
        }
    }

    public static function destroy() {
        session_destroy();
    }

}
