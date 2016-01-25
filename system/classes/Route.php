<?php

/*
  | Project: fw
  | Description: my framework
  | Author: Pham Ngoc Phu
  | Alias: Phu Master
  | Email: phumaster.dev@gmail.com
 */

class Route {

    private $param = [];
    private static $method;
    private static $controller;
    public static $routes = [];
    public static $target = [];

    public static function add($route, $target = null) {
        array_push(self::$routes, $route);
        array_push(self::$target, $target);
    }

    private static function setController($controller = null, $method = null, $parameter = null) {
        if (is_null($controller)) {
            return;
        }
        $file = __APP_PATH . '/' . Config::get('app')->controller_folder . '/' . $controller . '.php';
        if (!file_exists($file)) {
            return false;
        }
        $namespace = self::getNamespaceFile($file);

        $class = explode('/', $controller);
        $class = $namespace . '\\' . $class[count($class) - 1];
        $cl = new $class();

        if (is_null($method)) {
            if (!method_exists($cl, 'index')) {
                return false;
            }
            return $cl->index();
        }
        if (!method_exists($cl, $method)) {
            if (method_exists($cl, 'index')) {
                return $cl->index();
            }
            return false;
        }
        return $cl->$method();
    }

    private static function getNamespaceFile($name) {
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

    public static function getURI() {
        $uri = $_SERVER['REQUEST_URI'];
        $uri = trim($uri, '/');
        $u = explode('/', $uri);
        if ($u[0] == 'index.php') {
            array_shift($u);
        }
        $uri = implode('', $u);
        if($uri == '') {
            $uri = '/';
        }
        return $uri;
    }

    private static function setMethod($need = null) {
        if (is_null($need)) {
            return;
        }
        $method = trim($need, '/');
        $arr = explode('@', $method);

        self::$method = $arr[1];
        self::$controller = $arr[0];
    }

    private static function compare() {
        $uri = self::getURI();
        $i = 0;
        foreach (self::$routes as $route) {
            if($route != '/') {
                $route = trim($route, '/');
            }
            if ($route == $uri) {
                if (is_object(self::$target[$i])) {
                    call_user_func(self::$target[$i]);
                    break;
                }
                self::setMethod(self::$target[$i]);
                self::setController(self::$controller, self::$method);
                break;
            }
            $arr = explode('?', $uri);
            $new_uri = $arr[0];
            if ($route == $new_uri) {
                if (is_object(self::$target[$i])) {
                    call_user_func(self::$target[$i]);
                    break;
                }
                self::setMethod(self::$target[$i]);
                self::setController(self::$controller, self::$method);
                break;
            }
            $i++;
        }
    }

    public static function initialize() {
        self::compare();
    }

}
