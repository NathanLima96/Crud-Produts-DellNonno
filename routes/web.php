<?php

/** @var \Laravel\Lumen\Routing\Router $router */

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

$router->group(['prefix' => 'product'], function () use ($router) {
    $router->post('', 'ProductsController@create');
    $router->get('', 'ProductsController@getAll');
    $router->get('{id}', 'ProductsController@getId');
    $router->put('uploads', 'ProductsController@update');
    $router->put('{id}', 'ProductsController@update');
    $router->delete('{id}', 'ProductsController@delete');
});
