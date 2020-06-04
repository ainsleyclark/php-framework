<?php

if (! function_exists('public_path'))
{
    /**
     * Return public path of application.
     *
     * @param string $path
     * @return string
     */
    function public_path($path = '')
    {
        return base_path('public');
    }
}

if (! function_exists('root_path'))
{
    /**
     * Return route path of application.
     *
     * @param string $path
     * @return string
     */
    function route_path($path = '')
    {
        return route_path('routes');
    }
}