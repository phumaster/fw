<?php

/*
  | Project: fw
  | Description: my framework
  | Author: Pham Ngoc Phu
  | Alias: Phu Master
  | Email: phumaster.dev@gmail.com
 */
use PM\Config;

class Route {

    private static $uri;
    private static $route;
    private static $method;
    private static $controller;
    private static $routeOrigin;
    private static $routes = [];
    private static $target = [];
    private static $matches = [];
    private static $errors = true;

    private static function setRoute($route = null) {
        self::$route = $route;
    }

    private static function getParametersValue() {
        return array_diff(explode('/', self::$uri), explode('/', self::$routeOrigin));
    }

    private static function getParameters() {
        return array_combine(self::$matches, self::getParametersValue());
    }

    public static function add($route, $target = null) {
        array_push(self::$routes, $route);
        array_push(self::$target, $target);
    }

    public static function initialize() {
        self::getURI();
        self::compare();
    }

    private static function changeRouteToRegex() {
        self::getParametersName();
        self::$route = preg_replace('#{[\w]+}#', '[\w]+', self::$route);
        self::$route = preg_replace('#\/#', '\/', self::$route);
        self::$route = '^' . self::$route . '$';
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

    private static function getParametersName() {
        $arr = [];
        preg_match_all('#{[\w]+?}#', self::$route, $matches);

        if (count($matches) == 0) {
            return self::$matches = [];
        }

        foreach ($matches[0] as $match) {
            $arr[] = str_replace(' ', '', trim(trim($match, '{'), '}'));
        }

        return self::$matches = $arr;
    }

    private static function getURI() {
        $uri = $_SERVER['REQUEST_URI'];
        $uri = trim($uri, '/');
        $u = explode('/', $uri);

        if ($u[0] == 'index.php') {
            array_shift($u);
        }

        $uri = implode('/', $u);

        if ($uri == '') {
            $uri = '/';
        }

        self::$uri = $uri;
    }

    private static function setController($controller = null, $method = null, $parameter = null) {
        if (is_null($controller)) {
            return;
        }

        $file = __APP_PATH . '/' . Config::get('app')->controller_folder . '/' . $controller . '.php';

        if (!file_exists($file)) {
            return false;
        }

        $namespace = getNamespace($file);
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

        if (count($parameter) > 0) {
            return call_user_func_array([$cl, $method], $parameter);
        }
        return $cl->$method();
    }

    private static function compare() {
        $i = 0;
        foreach (self::$routes as $route) {
            if ($route != '/') {
                $route = trim($route, '/');
            }

            self::setRoute($route);
            if (self::$route == self::$uri) {
                if (is_object(self::$target[$i])) {
                    call_user_func(self::$target[$i]);
                    self::$errors = false;
                    break;
                }

                self::setMethod(self::$target[$i]);
                self::setController(self::$controller, self::$method);
                self::$errors = false;
                break;
            }

            $arr = explode('?', self::$uri);
            $new_uri = $arr[0];

            if (self::$route == $new_uri) {
                if (is_object(self::$target[$i])) {
                    call_user_func(self::$target[$i]);
                    self::$errors = false;
                    break;
                }

                self::setMethod(self::$target[$i]);
                self::setController(self::$controller, self::$method);
                self::$errors = false;
                break;
            }

            self::$routeOrigin = self::$route;
            self::changeRouteToRegex();

            if (preg_match_all('#' . self::$route . '#', self::$uri)) {
                $params = self::getParameters();

                if (is_object(self::$target[$i])) {
                    call_user_func_array(self::$target[$i], $params);
                    self::$errors = false;
                    break;
                }

                self::setMethod(self::$target[$i]);
                self::setController(self::$controller, self::$method, $params);
                self::$errors = false;
                break;
            }

            if (preg_match_all('#' . self::$route . '#', $new_uri)) {
                $params = self::getParameters();

                if (is_object(self::$target[$i])) {
                    call_user_func_array(self::$target[$i], $params);
                    self::$errors = false;
                    break;
                }

                self::setMethod(self::$target[$i]);
                self::setController(self::$controller, self::$method, $params);
                self::$errors = false;
                break;
            }
            $i++;
        }
        if (self::$errors) {
            throw new Exception('Route not found!');
        }
    }

}
