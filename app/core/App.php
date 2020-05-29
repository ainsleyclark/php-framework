<?php

namespace app\core;

require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/ViewMaker.php';

spl_autoload_register(function ($class)
{
    $base_path = str_ireplace('app/core', '', __DIR__);
    $class = explode('\\', $class);
    $class = end($class);

    if ($class !== '') {
        $loaded = false;

        $classRoutes = [
            'controllers',
            'core',
            'models',
            'helpers'
        ];

        foreach ($classRoutes as $classRoute) {
            $file = $base_path . 'app/' . $classRoute . '/' . $class . '.php';
            if (file_exists($file) && is_readable($file)) {
                require_once $file;
                $loaded = true;
            }
        }

        if (!$loaded) {
            var_dump($class);
            echo 'Class load failed';
            exit();
        }
    }
});



class App
{
    protected $router;

    public function __construct()
    {
        //print_r(basename($_SERVER['REQUEST_URI']));
        $this->router = new Router();
        $this->loadRoutes();
    }

    public function loadRoutes()
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

        $routesPath = str_ireplace('app/core', '', __DIR__) . 'routes/web.php';
        $routes = include $routesPath;


        try {
            @$this->router->get($request, $routes[$method][$request], $args);
        }catch (\Throwable $e){
            header("HTTP/1.0 404 Not Found");
            echo '404';
        }
    }


}