<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return 'Welcome to Lumen Dav Stack';
});

$router->group(['prefix' => '/dav'], function () use ($router) {
    
    $dav = app('dav-server');

    //dd($router);

    $router->get('/', function () use ($dav) {
         return $dav->exec();
    });

    $router->post('',function () use ($dav) { 
        return $dav->exec();
    });

    $router->put('', function () use ($dav) { 
        return $dav;
    });
    $router->patch('', function () use ($dav) {
        return $dav->exec();
    });
    $router->delete('/{route:.*}', function () use ($dav) { 
        return $dav->exec();
    });

});