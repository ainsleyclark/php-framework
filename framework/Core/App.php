<?php

namespace app\Core;

require_once 'bootstrap.php';

class App
{

    /**
     * @var
     */
    protected $router;

    /**
     * App constructor.
     */
    public function __construct()
    {
        dd('dfsdf');
        $this->loadHelpers();
    }

    /**
     * Includes all helper files
     */
    protected function loadHelpers() : void
    {
        //layout will fuck up
        $helperDir = base_path(SYSTEMPATHS['helpers']);
        $helperFiles = array_diff(scandir($helperDir), array('.', '..'));

        foreach($helperFiles as $file) {
            if (!is_dir($file) && pathinfo($file)['extension'] === 'php') {
                require_once $helperDir . '/' . $file;
            }
        }

    }

    /**
     *
     */
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
        } catch (\Throwable $e){
            header("HTTP/1.0 404 Not Found");
            echo '404';
        }
    }
}