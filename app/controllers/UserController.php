<?php

/*
 | Project: fw
 | Description: my framework
 | Author: Pham Ngoc Phu
 | Alias: Phu Master
 | Email: phumaster.dev@gmail.com 
 */

namespace App\controllers;

class UserController {
    
    public function index() {
        echo 'This is method index';
    }
    
    public function action() {
        echo "ACTION method";
        print_r($_GET);
    }
}