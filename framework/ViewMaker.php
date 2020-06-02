<?php


namespace app\core;


class ViewMaker
{

    public static function View($viewFile)
    {

        $base_path = str_ireplace('app/core', '', __DIR__);
        $file = $base_path . 'app/views/' . $viewFile . '.tmpl';

        if (file_exists($file) && is_readable($file)) {

            //fully process view here with args etc in future

            $rawFile = file_get_contents($file);
            echo $rawFile;
        }
    }

}