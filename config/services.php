<?php
 return [
    'users' => [
        'base_uri' => env('USERS_SERVICE_BASE_URL'),
        'secret' => env('USERS_SERVICE_SECRET'),
    ],

    'weather' => [
        'base_uri' => env('WEATHER_SERVICE_BASE_URL'),
        'secret' => env('WEATHER_SERVICE_SECRET'),
    ],

    'location' => [
        'base_uri' => env('LOCATION_SERVICE_BASE_URL'),
        'secret' => env('LOCATION_SERVICE_SECRET'),
    ],

    'flight' => [
        'base_uri' => env('FLIGHT_SERVICE_BASE_URL'),
        'secret' => env('FLIGHT_SERVICE_SECRET'),
    ],
 ];