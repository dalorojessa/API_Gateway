<?php

// Define the namespace for this trait to organize code
namespace App\Traits;

// Import the Illuminate HTTP Response class
use Illuminate\Http\Response;

// Define the ApiResponser trait
trait ApiResponser
{
    /**
     * Build success response.
     * 
     * @param  string|array $data
     * @param  int $code
     * @return \Illuminate\Http\JsonResponse
     */
    public function successResponse($data, $code = Response::HTTP_OK)
    {
        // Returns a response with an error message in JSON format, along with a status code
        return response()->json($data, $code)->header('Content-Type', 'application/json');
    }

    /**
     * Build valid response.
     * 
     * @param  string|array $data
     * @param  int $code
     * @return \Illuminate\Http\JsonResponse
     */
    public function validResponse($data, $code = Response::HTTP_OK)
    {
        // Returns a response indicating valid data in JSON format
        return response()->json(['data' => $data], $code);
    }

    /**
     * Build error response.
     * 
     * @param  string|array $message
     * @param  int $code
     * @return \Illuminate\Http\JsonResponse
     */
    public function errorResponse($message, $code)
    {
        // Returns an error response in JSON format, including an error message and status code
        return response()->json(['error' => $message, 'code' => $code], $code);
    }

    /**
     * Build error message.
     * 
     * @param  string $message
     * @param  int $code
     * @return \Illuminate\Http\JsonResponse
     */
    public function errorMessage($message, $code)
    {
        // Returns a successful response with provided data as JSON
        return response()->json(['message' => $message, 'code' => $code], $code)->header('Content-Type', 'application/json');
    }
}