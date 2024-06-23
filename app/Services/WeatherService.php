<?php

// Define the namespace for this service class to organize code
namespace App\Services;

// Import the GuzzleHttp client for making HTTP requests
use GuzzleHttp\Client;

// Define the WeatherService class
class WeatherService
{
    // Property to hold the GuzzleHttp client instance
    protected $client;
    // Property to hold the API key
    protected $apiKey;
    // Property to hold the API host URL
    protected $host;

    // Constructor method to initialize GUzzleHttp client, API key, and API host
    public function __construct()
    {
        // Initialize a new GuzzleHttp client instance
        $this->client = new Client();
        // Retrieve API key from env
        $this->apiKey = env('RAPIDAPI_KEY');
        // Retrive API host from env
        $this->host = env('RAPIDAPI_WEATHER_HOST');
    }

    // Method to fetch weather data for a specific city
    public function getWeather($city)
    {
        // Query parameters
        $response = $this->client->request('GET', "https://{$this->host}/city/{$city}/EN", [
            'headers' => [
                // Set API host header
                'X-RapidAPI-Host' => $this->host,
                // Set API key header
                'X-RapidAPI-Key' => $this->apiKey,
            ],
        ]);
        
        // Decode JSON response and return as array
        return json_decode($response->getBody()->getContents(), true);
    }
}
