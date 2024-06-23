<?php

// Define the namespace for this controller class to organize the code
namespace App\Http\Controllers;

// Import the WeatherService class
use App\Services\WeatherService;
// Import the BaseController class
use Laravel\Lumen\Routing\Controller as BaseController;

// Define the WeatherController class that extends the base controller
class WeatherController extends BaseController
{
    // Property to hold the WeatherService instance
    protected $weatherService;

    // Contructor method to initialize the WeatherService    
    public function __construct(WeatherService $weatherService)
    {
        $this->weatherService = $weatherService;
    }

    // Method to fetch and return weather information for a specific city
    public function show($city)
    {
        // Use the weatherService/ weather service to get weather data for the specified city
        $weather = $this->weatherService->getWeather($city);
        // Return the weather data as a JSON response
        return response()->json($weather);
    }
}
