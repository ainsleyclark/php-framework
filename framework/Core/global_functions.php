<?php

if (! function_exists('base_path'))
{
    /**
     * Return base path of application.
     *
     * @param string $path
     * @return string
     */
    function base_path($path = '')
    {
        return str_replace('//' ,'/',str_ireplace('/' . SYSTEMPATHS['core'], '/', __DIR__) . '/' . $path);
    }
}

function getPath($path, $requestFile = '')
{
    if (array_key_exists($path, SYSTEMPATHS)) {
        return str_replace('//' ,'/', base_path() . SYSTEMPATHS[$path] . '/' . $requestFile);
    }else{
        return null;
    }
}

function getConf($configFile)
{
    try {
        return include_once base_path(SYSTEMPATHS['config'] . '/' . $configFile . '.php');
    }catch (\Throwable $e) {
        dd($e->getMessage());
    }
}

//if (! function_exists('dd'))
//{
//    function dd()
//    {
//       // \app\framework\Support\Errors::dd();
//    }
//}

function dd()
{



    $view = new \app\Framework\Core\ViewMaker();

    echo $view->make('test', [
        'test' => 'hey',
        'array' => [
            'hello',
            'test',
            'fuck'
        ]
    ]);

    die();
//    echo \app\Framework\Core\ViewMaker::View('test', [
//        'test' => 'whatever'
//    ]);

    exit();
}

