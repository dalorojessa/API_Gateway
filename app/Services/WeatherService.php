<?php

namespace App\Services;

use GuzzleHttp\Client;

class WeatherService
{
    protected $client;
    protected $apiKey;
    protected $host;

    public function __construct()
    {
        $this->client = new Client();
        $this->apiKey = env('RAPIDAPI_KEY');
        $this->host = env('RAPIDAPI_WEATHER_HOST');
    }

    public function getWeather($city)
    {
        $response = $this->client->request('GET', "https://{$this->host}/city/{$city}/EN", [
            'headers' => [
                'X-RapidAPI-Host' => $this->host,
                'X-RapidAPI-Key' => $this->apiKey,
            ],
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }
}
