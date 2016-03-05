<?php

/*
  | Project: fw
  | Description: my framework
  | Author: Pham Ngoc Phu
  | Alias: Phu Master
  | Email: phumaster.dev@gmail.com
 */

class App {

    private $class = ['Config', 'Session', 'Redirect', 'DB', 'Controller', 'View', 'Route'];

    public function __call($name, $arguments) {
        $this->initialize();
    }

    private function initialize() {
        foreach ($this->class as $class) {
            require __SYSTEM_PATH . '/classes/' . $class . '.php';
        }
    }

    public function __destruct() {
        require __SYSTEM_PATH . '/common/functions_app.php';
        require __APP_PATH . '/routes.php';
        try {
            (new Route())->initialize();
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

}
