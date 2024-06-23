<?php

// Import LogController
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

// Default route to display the application version
$router->get('/', function () use ($router) {
    return $router->app->version();
});

// Grouping routes with 'client.credentials' middleware
$router->group(['middleware' => 'client.credentials'],function() use ($router) {

// Weather endpoint to show weather for specific city
$router->get('/weather/{city}', 'WeatherController@show');
// Geocode endpoint to perform geocoding based on address
$router->get('/geocode', 'GeocodingController@geocode');
// Flight autocomplete endpoint for flight search autocomplete
$router->get('/flights/auto-complete', 'FlightController@autoComplete');
// Flight search endpoint for one-way flights
$router->get('/flights/one-way/search', 'FlightController@searchOneWayFlight');
// Recent logs endpoint to retrieve recent logs
$router->get('/logs/recent', 'LogController@recentLogs');

$router->get('/users',['uses' => 'UserController@getUsers']); // Get all users
$router->get('/users', 'UserController@index');   // get all users 
$router->post('/users', 'UserController@add');  // create new user 
$router->get('/users/{id}', 'UserController@show'); // get user by id
$router->put('/users/{id}', 'UserController@update'); // update user 
$router->delete('/users/{id}', 'UserController@delete'); // delete user

});