<?php

// Define the namespace for this controller class to organize the code
namespace App\Http\Controllers;

// Import the RequestLog model
use App\Models\RequestLog;

// Define the LogController that extends the base Controller
class LogController extends Controller
{
    // Method to get the recentLogs/recent logs
    public function recentLogs()
    {
        // Fetch the 15 most recent logs, ordered by creation time/created_at in descending order
        $logs = RequestLog::orderBy('created_at', 'desc')->take(15)->get();

        // Return the logs as a JSON response
        return response()->json($logs);
    }
}
