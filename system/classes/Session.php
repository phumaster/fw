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
        unset($_SESSION[$name]);
    }

    public static function get($name = NULL) {
        if (!isset($_SESSION[$name]) && !isset($_SESSION['__PM_FLASH_MSG'][$name])) {
            return;
        } else if (isset($_SESSION[$name])) {
            return $_SESSION[$name];
        } else {
            if (isset($_SESSION['__PM_FLASH_MSG']) && is_array($_SESSION['__PM_FLASH_MSG'])) {
                if (!isset($_SESSION['__PM_FLASH_MSG'][$name])) {
                    return;
                }
                $flashSession = $_SESSION['__PM_FLASH_MSG'][$name];
                self::unsetFlashData($name);
                return $flashSession;
            }
        }
        return;
    }

    private static function unsetFlashData($name = NULL) {
        unset($_SESSION['__PM_FLASH_MSG'][$name]);
    }

    public static function flash($session = []) {
        foreach ($session as $name => $value) {
            $_SESSION['__PM_FLASH_MSG'][$name] = $value;
        }
    }

    public static function destroy() {
        session_destroy();
        unset($_SESSION);
    }

}
