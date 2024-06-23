<?php

// Define the namespace for this model class to organize code
namespace App\Models;

// Import the base Eloquent Model class
use Illuminate\Database\Eloquent\Model;

// Define the RequestLog class that extends the Model
class RequestLog extends Model
{
    protected $fillable = [
        // Specify that the endpoint and request data are fillable attributes
        'endpoint', 'request_data',
    ];
}
