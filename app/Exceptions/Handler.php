<?php

// Define the namespace to organize the code
namespace App\Exceptions;

// Use the ApiResponser trait that provides the methods for uniform API responses
use App\Traits\ApiResponser;

// Import the necessarry exception classes
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use Laravel\Lumen\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Throwable;
use Illuminate\Http\Response;

// Define the exception Handler class that extends the base ExceptionHandler
class Handler extends ExceptionHandler
{
    // Use the ApiResponser trait
    use ApiResponser;

    // Define the types of exceptions that should not be reported
    protected $dontReport = [
        AuthorizationException::class,
        HttpException::class,
        ModelNotFoundException::class,
        ValidationException::class,
    ];

    // Method to report exceptions
    public function report(Throwable $exception)
    {
        // Call the parent class's report method
        parent::report($exception);
    }

    // Method to render exceptions into HTTP response
    public function render($request, Throwable $exception)
    {
        // Handle the HttpException or if http is not found 
        if ($exception instanceof HttpException) {
            // Get the status code of the exception
            $code = $exception->getStatusCode();
            // Get the corresponding status text
            $message = Response::$statusTexts[$code];
            // Return the error response
            return $this->errorResponse($message, $code);
        }

        // Handle the ModelNotFoundException or if the instance is not found
        if ($exception instanceof ModelNotFoundException) {
            // Get the name of the missing model
            $model = strtolower(class_basename($exception->getModel()));
            // Return the error response
            return $this->errorResponse("No instance of {$model} with the given ID", Response::HTTP_NOT_FOUND);
        }

        // Handle the ValidationException or validation exception
        if ($exception instanceof ValidationException) {
            // Get the validation error message
            $errors = $exception->validator->errors()->getMessages();
            // Return the error response
            return $this->errorResponse($errors, Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        // Handle the AuthorizationException or access to forbidden 
        if ($exception instanceof AuthorizationException) {
           // Return the error response with the exception message
            return $this->errorResponse($exception->getMessage(), Response::HTTP_FORBIDDEN);
        }

        // Handle the AuthenticationException or unauthorized access
        if ($exception instanceof AuthenticationException) {
            // Return the error response with the exception message
            return $this->errorResponse($exception->getMessage(), Response::HTTP_UNAUTHORIZED);
        }

        // Handle the ClientException
        if ($exception instanceof ClientException) {
            // Get the response body of the exception
            $message = $exception->getResponse()->getBody()->getContents();
            // Get the status code of the exception
            $code = $exception->getCode();
            // Return the error message
            return $this->errorMessage($message, $code);
        }
        
        // If the application is in debug mode or if your are running in development environment
        if (env('APP_DEBUG', false)) {
            return parent::render($request, $exception);
        }

        // For any other exceptions, it returns this error response
        return $this->errorResponse('Unexpected error. Try later', Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}
