<?php

// Web Routes
//Route::get('/home', 'HomeController@index');
//Route::get('/home', 'HomeController@index');

return [
    'get' => [
        '/' => 'HomeController@home',
        '/home' => 'HomeController@index',

    ],
    'post' => [
        '/home' => 'HomeController@save'
    ]
];