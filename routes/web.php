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
    return $router->app->version();
});

$router->group(['prefix' => 'v1', 'namespace' => 'V1'], function($api) {
    
    $api->group(['as' => 'NoAuthRequired'], function($api) {
        $api->post('auth', 'AuthController@auth');
        $api->post('user/create', 'UserController@store');
    });
    $api->group(['as' => 'AuthRequired', 'middleware' => ['auth:api']], function($api) {
        $api->get('recipes', 'RecipeController@index');
        $api->post('recipes/create', 'RecipeController@store');
        $api->delete('recipes/{id}', 'RecipeController@destroy');
    });
});