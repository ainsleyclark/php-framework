<?php

namespace app\core;

// Should only be loading stuff from controllers
// run dir scan to see if any existts.

class Router
{
    public $request;

    public function __construct()
    {
        $this->request = $_SERVER['REQUEST_URI'];
        $this->loadRoutes();
    }

    public function resolveRoute($classRoute, $args)
    {
            $route = explode('@', $classRoute);

            $cname = str_replace('/', '\\', systemPaths['controllers']) . '\\' . $route[0];
            $controller = new $cname;
            $route1 = $route[1];
            $function = $controller->$route1($args);

            return $function;
    }

    private function loadRoutes()
    {
        $method = strtolower($_SERVER['REQUEST_METHOD']);
        $uri = explode('?', $_SERVER['REQUEST_URI']);
        $request = $uri[0];

        $tempArgs = (array_key_exists(1, $uri)) ? explode('&', $uri[1]) : [];
        $args = [];

        foreach ($tempArgs as $arg) {
            $arg = explode('=', $arg);
            $args[$arg[0]] = $arg[1];
        }

        $routesPath = base_path('routes/web.php');
        $routes = include $routesPath;


        try {
            @$this->resolveRoute($routes[$method][$request], $args);
        }catch (\Throwable $e){
            error('Error Code: ' . $e->getCode(), $e->getMessage(), $e->getFile() . '   |   Line Number: ' . $e->getLine(), $e->getTrace());
        }
    }
}
