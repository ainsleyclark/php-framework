<?php

// Web Routes
return [
    'get' => [
        '/' => 'HomeController@home',
        '/home' => 'HomeController@index',

    ],
    'post' => [
        '/home' => 'HomeController@save'
    ]
];