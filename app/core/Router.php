<?php

namespace app\core;

// Should only be loading stuff from controllers
// run dir scan to see if any existts.

class Router
{

    public $request;

    public $routes = [];

    public function __construct()
    {
        $this->request = basename($_SERVER['REQUEST_URI']);
    }

    public function get(string $uri, $classRoute, $args)
    {
        try {
            $route = explode('@', $classRoute);

            $cname = "app\\controllers\\" . $route[0];
            $controller = new $cname;
            $route1 = $route[1];
            $function = $controller->$route1($args);

            return $function;
        } catch (\Exception $e) {
            echo '404 mofo';
        }
    }

    /**
     * Determine if requested route exists in route array.
     *
     * @param string $uri
     * @return bool
     */
    public function has(string $uri) : bool
    {
        return array_key_exists($uri, $this->routes);
    }

    /**
     * Run the router.
     *
     * @return mixed
     */
    public function run()
    {
        print_r($this->routes);
        if($this->has($this->request)) {
            $this->routes[$this->request]->call($this);
        }
    }
}
