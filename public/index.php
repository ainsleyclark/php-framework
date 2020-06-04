<?php

/**
 * System Config Paths
 */
CONST SYSTEMPATHS = [
    'core' => 'framework/Core',
    'routes' => 'routes',
    'controllers' => 'app/Controllers',
    'framework' => 'framework',
    'helpers' => 'framework/Helpers',
    'models' => 'app/Models',
    'views' => 'app/Views',
    'vendor' => 'vendor',
    'config' => 'framework/config',
];

/**
 * App Init
 */
require_once './../framework/core/App.php';
$app = new \app\core\App();