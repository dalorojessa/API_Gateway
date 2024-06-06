<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\RequestLog;

class LogRequestsMiddleware
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        RequestLog::create([
            'endpoint' => $request->path(),
            'request_data' => json_encode($request->all()),
        ]);

        return $response;
    }
}
