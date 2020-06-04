<?php

// Include required files

require_once __DIR__ . '/../../vendor/autoload.php';
require_once 'global_functions.php';

/**
 * Configure auto class loading for namespace resolution
 */
spl_autoload_register(function ($class)
{
    $class = explode('\\', $class);
    $class = end($class);

    if ($class !== '') {
        $loaded = false;

        $classRoutes = [
            'framework',
            'controllers',
            'core',
            'models',
            'helpers'
        ];

        foreach ($classRoutes as $classRoute) {
            $file = getPath($classRoute, $class . '.php');
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