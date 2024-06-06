<?php
use App\Http\Controllers\LogController;

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

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['middleware' => 'client.credentials'],function() use ($router) {

$router->get('/weather/{city}', 'WeatherController@show');
$router->get('/geocode', 'GeocodingController@geocode');
$router->get('/flights/auto-complete', 'FlightController@autoComplete');
$router->get('/flights/one-way/search', 'FlightController@searchOneWayFlight');
$router->get('/logs/recent', 'LogController@recentLogs');

$router->get('/users', 'UserController@index');   
$router->post('/users', 'UserController@add');  
$router->get('/users/{id}', 'UserController@show'); 
$router->put('/users/{id}', 'UserController@update'); 
$router->delete('/users/{id}', 'UserController@delete');

});