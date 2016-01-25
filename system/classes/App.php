<?php

/*
  | Project: fw
  | Description: my framework
  | Author: Pham Ngoc Phu
  | Alias: Phu Master
  | Email: phumaster.dev@gmail.com
 */

class App {

    private $class = ['Config', 'Model', 'Controller', 'View', 'Route'];


    public function __call($name, $arguments) {
        // initialize
        $this->initialize();
    }

    private function initialize() {
        
        // load resource for application
        
        foreach( $this->class as $class) {
            require_once __SYSTEM_PATH.'/classes/'.$class.'.php';
        }
        
    }
    
    public function __destruct() {
        require_once __APP_PATH.'/routes.php';
        Route::initialize();
    }

}
