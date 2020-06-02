<?php

/**
 * Base Config for framework
 */
CONST systemPaths = [
    'routes' => 'routes',
    'controllers' => 'app/controllers',
    'framework' => 'framework',
    'helpers' => 'framework/helpers',
    'models' => 'app/models',
    'views' => 'app/views',
    'vendor' => 'vendor',
    'config' => 'config',
];
include __DIR__ . '/../' . systemPaths['framework'] . '/helpers/global_functions.php';


/**
 * App init
 */
require_once getPath('framework', 'App.php');
$app = new \app\core\App();