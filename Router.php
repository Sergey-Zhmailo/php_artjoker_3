<?php

class Router{

    private static $instance;

    private function __construct()
    {
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function register(){
        $routes = require_once ("configs/router.php");

        $segments = explode("?", $_SERVER["REQUEST_URI"]);
        $segmentsStr = trim($segments[0], "/");

        $found = false;
        foreach($routes as $patternUrl => $route){
            if(isset($route[$_SERVER["REQUEST_METHOD"]])
                && preg_match("#^".$patternUrl."$#", $segmentsStr)) {

                $route = $route[$_SERVER["REQUEST_METHOD"]];

                $params = $route["params"];


                if(strpos($params, "$") !== false){
                    $params = preg_replace("#^".$patternUrl."$#",
                        $params, $segmentsStr); // 12/43
                    $params = explode("/", $params);
                }else {
                    $params = [];
                }


                $controller = $route["controller"];
                $action = $route["action"];

                $object = new $controller();

                call_user_func_array([$object, $action], $params);
                $found = true;
                return;
            }
        }
        if (!$found) {
            // 404 errror
            $controller = '\controllers\Error';
            $action = 'error';
            $object = new $controller();
            call_user_func_array([$object, $action], []);
        }

    }

    private function __sleep()
    {

    }

    private function __wakeup()
    {

    }
}