<?php


class SystemOutput
{

    public static function returnDD()
    {
//        echo '<style>html { background: black; }</style>';
//        echo '<h2 style="color: green; margin-bottom: 15px; font-family: sans-serif;">DD Output:</h2>';
//        echo '<pre style="color: green; font-size: 16px; font-weight: bold;">';
//
//        $args = func_get_args();
//        var_export($args);
//
//        echo '</pre>';

        return \app\Framework\Core\ViewMaker::View('test', [
            'test' => 'testing'
        ]);
    }
}