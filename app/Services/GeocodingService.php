<?php

namespace App\Services;

use GuzzleHttp\Client;

class GeocodingService
{
    protected $client;
    protected $host;
    protected $apiKey;

    public function __construct()
    {
        $this->client = new Client();
        $this->host = env('RAPIDAPI_GEOCODING_HOST');
        $this->apiKey = env('RAPIDAPI_KEY');
    }

    public function geocodeAddress($address)
    {
        $response = $this->client->request('GET', "https://{$this->host}/json?address=" . urlencode($address), [
            'headers' => [
                'X-RapidAPI-Host' => $this->host,
                'X-RapidAPI-Key' => $this->apiKey,
            ],
        ]);

        return json_decode($response->getBody(), true);
    }
}
