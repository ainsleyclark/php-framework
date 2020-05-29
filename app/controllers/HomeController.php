<?php

namespace app\controllers;

use app\controllers\Controller;
use app\models\TestModel;

class HomeController extends Controller
{
    protected $testModel;

    public function __construct()
    {
        $this->testModel = new TestModel();
    }

    public function home()
    {
        echo 'Home';
    }

    public function index($args)
    {
        //echo $this->testModel->test();
        echo 'hello ' . $args['name'] . ' ' . $args['surname'];
    }

    public function save()
    {
        echo 'saving';
    }
}