<?php

// Define the namespace for this controller class to organize the code
namespace App\Http\Controllers;

// Import the Request class
use Illuminate\Http\Request;
// Import the FlightService class
use App\Services\FlightService;

// Define the FlightController class that extends the base Controller
class FlightController extends Controller
{
    // Property to hold the FlightService instance
    protected $flightService;

    // Constructor to initialize the FlightService instance
    public function __construct(FlightService $flightService)
    {
        $this->flightService = $flightService;
    }

    // Method the handle autoComplete requests
    public function autoComplete(Request $request)
    {
        // Get the 'q' input/parameter from the request, defaulting to 'Philippines' if not provided
        $query = $request->input('q', 'Philippines');
        // Call the getAutoComplete method on the flightService with the query
        $result = $this->flightService->getAutoComplete($query);

        // Return the result as a JSON reponse
        return response()->json($result);
    }

    // Method to handle searchOneWayFlight/one-way flight search requests
    public function searchOneWayFlight(Request $request)
    {
        // Get the required parameters from the requests, this is for flying_from
        $flyingFrom = $request->input('flying_from');
        // This is for flying_to
        $flyingTo = $request->input('flying_to');
        // This is for departure_date
        $departureDate = $request->input('departure_date');
        // This for search_types
        $searchType = $request->input('search_type');

        // To check if any of the required parameters are missing
        if (!$flyingFrom || !$flyingTo || !$departureDate || !$searchType) {
            // Return an error response if any required parameter is missing as a JSON response
            return response()->json(['error' => 'Missing required parameters'], 400);
        }

        // Use the flight service to search for one-way flights based on the provided parameters
        $result = $this->flightService->searchOneWayFlight($flyingFrom, $flyingTo, $departureDate, $searchType);

        // Return the search results as a JSON reponse
        return response()->json($result);
    }
}
