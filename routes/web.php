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
$router->group(['prefix' => 'api', 'middleware' => 'cors'], function () use ($router) {
    $router->get('happiness', 'HappinessController@getAll');
    $router->get('happiness/{id}', 'HappinessController@get');
    $router->post('happiness', 'HappinessController@store');
    $router->put('happiness/{id}', 'HappinessController@update');
    $router->delete('happiness/{id}', 'HappinessController@destroy');
});
