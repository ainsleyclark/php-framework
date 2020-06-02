<?php

namespace app\core;

require_once 'Bootstrap.php';

class App
{
    protected $router;

    public function __construct()
    {
        $this->router = new Router();
    }
}