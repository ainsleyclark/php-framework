<?php

/**
 *
 */
require_once getPath('helpers', 'global_functions.php');
require_once getPath('vendor', 'autoload.php');
require_once getPath('core', 'ViewMaker.php');

spl_autoload_register(function ($class)
{
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