<?php

// Define the namespace for this controller class to organize the code
namespace App\Http\Controllers;

// Import the GeocodingService class
use App\Services\GeocodingService;
// Import the Request class
use Illuminate\Http\Request;

// Define the GeocodingController class that extends the base Controller
class GeocodingController extends Controller
{
    // Property to hold the GeocodingService instance
    protected $geocodingService;

    // Constructor method to initialize the GeocodingService
    public function __construct(GeocodingService $geocodingService)
    {
        $this->geocodingService = $geocodingService;
    }

    // Method to handle geocode/geocoding requests
    public function geocode(Request $request)
    {
        // Get the address parameter from the request
        $address = $request->input('address');

        // Use the geocodingService to get geocode results based on the address
        $result = $this->geocodingService->geocodeAddress($address);

        // Return the results as a JSON response
        return response()->json($result);
    }
}
