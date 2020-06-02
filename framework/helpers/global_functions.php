<?php

function dd()
{
    echo '<style>html { background: black; }</style>';
    echo '<pre style="color: green; font-size: 14px; font-weight: bold;">';

    $args = func_get_args();
    var_export($args);

    echo '</pre>';
    exit();
}

function base_path($path)
{
    return str_replace('//' ,'/',str_ireplace('app/helpers', '', __DIR__) . $path);
}

function getPath($path, $requestFile = '')
{
    $base = str_ireplace(basename(__DIR__), '', __DIR__) . '/../';

    if (array_key_exists($path, systemPaths)) {
        return str_replace('//' ,'/', $base . systemPaths[$path] . '/' . $requestFile);
    }else{
        return null;
    }
}

