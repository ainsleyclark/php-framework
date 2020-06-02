<?php


namespace app\core;


class ViewMaker
{

    public static function View($viewFile)
    {
        $file = getPath('views', $viewFile . '.tmpl');


        if (file_exists($file) && is_readable($file)) {

            //fully process view here with args etc in future

            $rawFile = file_get_contents($file);
            echo $rawFile;
        }else{
            dd($file . '  not found');
        }
    }

}