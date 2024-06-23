<?php

// Define the namespace for this model class to organize code
namespace App\Models;

// Import the base Eloquent Model class
use Illuminate\Database\Eloquent\Model;

// Define the User class that extends the Model
class User extends Model{

    // Specifies the database table associated with this model
    protected $table = 'tbllogin';
    
    // column of the table
    protected $fillable = [
        // Specifies that email and password are fillable attributes
        'email', 'password'
    ];

    // Disables the automatic management of created_at and updated_at timestamps
    public $timestamps = false;

    // Specifies the primary key collumn name for the model
    protected $primaryKey = 'id';

    // Specifies that the password attribute should be hidden
    protected $hidden = ['password'];
}