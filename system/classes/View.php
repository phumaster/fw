<?php

/*
  | Project: fw
  | Description: my framework
  | Author: Pham Ngoc Phu
  | Alias: Phu Master
  | Email: phumaster.dev@gmail.com
 */
namespace PM;

class View {

    public static function make($viewName = NULL, $param = NULL) {
        if (is_null($viewName)) {
            return;
        }
        if (!is_null($param) && is_array($param)) {
            extract($param);
        }
        require __APP_PATH . '/' . Config::get('app')->view_folder . '/' . $viewName . '.php';
    }

}
