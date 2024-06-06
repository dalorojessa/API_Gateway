<?php

namespace App\Services;

use App\Traits\ConsumesExternalService;

class UserService{

    use ConsumesExternalService;
    /**
     * The base uri to consume the User Service
     * @var string
     */
    public $baseUri;

    /**
     * The secret to consume the User Service
     * @var string
     */
    public $secret;

    public function __construct()
    {
        $this->baseUri = config('services.users.base_uri');
        $this->secret = config('services.users.secret');
    }

     /**
     * Obtain the full list of Users from User Site
     * @return string
     */
    
     public function obtainUsers()
     {
         return $this->performRequest('GET','/users'); 
     }

      /**
     * Create one user using the User service
     * @return string
     */
    public function createUser($data)
    {
        return $this->performRequest('POST', '/users', $data);
    }

     /**
     * Obtain one single user from the User service
     * @return string
     */
    public function obtainUser($id)
    {
        return $this->performRequest('GET', "/users/{$id}");
    }

     /**
     * Update an instance of user using the User service
     * @return string
     */
    public function editUser($data, $id)
    {
        return $this->performRequest('PUT', "/users/{$id}", $data);
    }

     /**
     * Remove an existing user
     * @return Illuminate\Http\Response
     */
    public function deleteUser($id)
    {
        return $this->performRequest('DELETE', "/users/{$id}");
    }

}
