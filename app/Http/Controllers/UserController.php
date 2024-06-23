<?php

// Define the namespace for this controller class to organize the code
namespace App\Http\Controllers;

// Import the necessary classes and traits
 use Illuminate\Http\Request;
 use App\Models\User;
 use Illuminate\Http\Response;
 use App\Traits\ApiResponser;

// Define the UserController class that extends the base Controller
 Class UserController extends Controller {

    // Use the ApiResponser trait
    use ApiResponser;

    // Property to hold the request instance
    private $request;

    // Constructor method to initialize the request instance
    public function __construct(Request $request){
        $this->request = $request;
    }

    // Method to get all users
    public function getUsers(){
        // Fetch all users from the User model
        $users = User::all();
        // Return the users as a JSON response with the status code 200
        return response()->json($users, 200);
    }
    /**
     * Return the list of users
     * @return Illuminate\Http\Response
     */
    public function index()
    {
        // Fetch all users from the User model
        $users = User::all();
        // Return a successful response with the users data
        return $this->successResponse($users);
    }

    // Method to add a new user
    public function add(Request $request ){
        // Define the validation rules
        $rules = [
            // Email is required with a maximum of 30 characters/letters
            'email' => 'required|max:30',
            // Password is required with a maximum of 20 characters/letters
            'password' => 'required|max:20',
        ];
        // Validate the request data against the rules
        $this->validate($request,$rules);
        // Create a new user with the request data
        $user = User::create($request->all());
        // Return a successful response with the created user data and status code 201
        return $this->successResponse($user, Response::HTTP_CREATED);
    }

    /**
     * Obtains and show one user
     * @return Illuminate\Http\Response
     */
    public function show($id)
    {
        // Find the user by ID, or fail if not found
         $user = User::findOrFail($id);
        // Return a successful response with the user data
         return $this->successResponse($user);
    }

    /**
     * Update an existing author
     * @return Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        // Define validation rules
        $rules = [
        // Email with a maximum of 30 characters/letters
        'email' => 'max:30',
        // Password with a maximum of 20 characters/letters
        'password' => 'max:20',
        ];
        // Validate the request data against the rules
        $this->validate($request, $rules);
        // Find the user by ID, or fail if not found
        $user = User::findOrFail($id);
        // Fill the user with the request data            
        $user->fill($request->all());
        // If no changes happen
        if ($user->isClean()) {
            // Return an error response indicating that at least one value must change
            return $this->errorResponse('At least one value must change', Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        // Save the updated user data
        $user->save();
        // Return a successful response with the updated user data
        return $this->successResponse($user);
    }

       /**
     * Remove an existing user
     * @return Illuminate\Http\Response
     */
    public function delete($id)
    {
        // Find the user by ID, or fail if not found
        $user = User::findOrFail($id);
        // Delete the user
        $user->delete();
        // Return a successful response with the deleted user data
        return $this->successResponse($user);
    }
}