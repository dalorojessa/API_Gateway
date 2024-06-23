<?php

// Define the namespace for this middleware class to organize code 
namespace App\Http\Middleware;

// Import the Closure class for middleware handling
use Closure;
// Import the RequestLog model for logging requests
use App\Models\RequestLog;

// Define the LogRequestsMiddleware class
class LogRequestsMiddleware
{
    // Method to handle incoming requests
    public function handle($request, Closure $next)
    {
        // Process the request and get the response from the next middleware
        $response = $next($request);
        // Log the request details into the RequestLog model
        RequestLog::create([
            // Store the endpoint of the request
            'endpoint' => $request->path(),
            // Store the request data as JSON
            'request_data' => json_encode($request->all()),
        ]);
        
        // Return the response to continue the middleware chain
        return $response;
    }
}
