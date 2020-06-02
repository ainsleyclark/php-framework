<?php


function dd()
{
    echo '<style>html { background: black; }</style>';
    echo '<h2 style="color: green; margin-bottom: 15px; font-family: sans-serif;">DD Output:</h2>';
    echo '<pre style="color: green; font-size: 16px; font-weight: bold;">';

    $args = func_get_args();
    var_export($args);

    echo '</pre>';
    exit();
}

function error()
{
    echo '<style>html { background: black; }</style>';
    echo '<h2 style="color: red; margin-bottom: 15px; font-family: sans-serif;">Error Output:</h2>';
    echo '<pre style="color: red; font-size: 16px; font-weight: bold;">';

    $args = func_get_args();
    var_export($args);

    echo '</pre>';
    exit();
}

function base_path($path = '')
{
    return str_replace('//' ,'/',str_ireplace(systemPaths['framework'] . '/helpers', '', __DIR__) . '/' . $path);
}

function getPath($path, $requestFile = '')
{
    if (array_key_exists($path, systemPaths)) {
        return str_replace('//' ,'/', base_path() . systemPaths[$path] . '/' . $requestFile);
    }else{
        return null;
    }
}

function getConf($configFile)
{
    try {
        return include_once base_path(systemPaths['config'] . '/' . $configFile . '.php');
    }catch (\Throwable $e) {
        dd($e->getMessage());
    }

}

