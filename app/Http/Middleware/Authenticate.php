<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Factory as Auth;
use App\Traits\ApiResponser;

class Authenticate
{
    use ApiResponser;

    protected $auth;

    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    public function handle($request, Closure $next, $guard = null)
    {
        if ($this->auth->guard($guard)->guest()) {
            return $this->errorResponse('Unauthenticated', 401);
        }

        return $next($request);
    }
}
