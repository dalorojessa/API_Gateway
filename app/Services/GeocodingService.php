<?php

// Define the namespace for this service class to organize code
namespace App\Services;

// Import the Guzzle Http client for making HTTP requests
use GuzzleHttp\Client;

// Define the GeocodingService class
class GeocodingService
{
    // Property to hold the GuzzleHttp client instance
    protected $client;
    // Property to hold the API host URL
    protected $host;
    // Property to hold the API key
    protected $apiKey;

    // Constructor method to initialize GuzzleHttp client, API host, and API key
    public function __construct()
    {
        // Initialize a new GuzzleHttp client instance
        $this->client = new Client();
        // Retrieve API host URL from env
        $this->host = env('RAPIDAPI_GEOCODING_HOST');
        // Retrive API key from env
        $this->apiKey = env('RAPIDAPI_KEY');
    }

    // Method to geocode an address and fetch geographic coordinates
    public function geocodeAddress($address)
    {
        // Query parameters
        $response = $this->client->request('GET', "https://{$this->host}/json?address=" . urlencode($address), [
            'headers' => [
                // Set API host header
                'X-RapidAPI-Host' => $this->host,
                // Set API key header
                'X-RapidAPI-Key' => $this->apiKey,
            ],
        ]);

        // Decode JSON response and return as array
        return json_decode($response->getBody(), true);
    }
}
