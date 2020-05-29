<?php

namespace app\controllers;

use app\controllers\Controller;
use app\core\ViewMaker;
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
        ViewMaker::View('home');
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