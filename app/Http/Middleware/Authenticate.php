<?php

// Define the namespace for this middleware class to organize code
namespace App\Http\Middleware;

// Import the Closure class for middleware handling
use Closure;
// Import the Auth contract for authentication
use Illuminate\Contracts\Auth\Factory as Auth;
// Import the ApiResponser trait for consistent API respones
use App\Traits\ApiResponser;

// Define the Authenticate class
class Authenticate
{
    // Use the ApiResponser
    use ApiResponser;

    // Property to hold the Auth instance
    protected $auth;

    // Constructor method to inject the Auth instance
    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    // Method to handle incoming requests
    public function handle($request, Closure $next, $guard = null)
    {
        // Check if the user is authenticated using specified guard
        if ($this->auth->guard($guard)->guest()) {
            // Return an error response if the user is unauthenticated (HTTP status code 401)
            return $this->errorResponse('Unauthenticated', 401);
        }

        // Proceed to the next middleware if authenticated
        return $next($request);
    }
}
