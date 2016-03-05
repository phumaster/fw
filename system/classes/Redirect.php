<?php

/*
 | Project: fw
 | Description: my framework
 | Author: Pham Ngoc Phu
 | Alias: Phu Master
 | Email: phumaster.dev@gmail.com
 */
namespace PM;

class Redirect {
    public static function to($target) {
        return header("Location: {$target}");
    }
    
    public function with($flashMsg = []) {
        Session::flash($flashMsg);
        return;
    }
}
