<?php

namespace App\Http\Controllers;

use App\Services\WeatherService;
use Laravel\Lumen\Routing\Controller as BaseController;

class WeatherController extends BaseController
{
    protected $weatherService;

    public function __construct(WeatherService $weatherService)
    {
        $this->weatherService = $weatherService;
    }

    public function show($city)
    {
        $weather = $this->weatherService->getWeather($city);
        return response()->json($weather);
    }
}
