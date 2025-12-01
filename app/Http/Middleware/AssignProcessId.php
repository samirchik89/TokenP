<?php

namespace App\Http\Middleware;
use Ramsey\Uuid\Uuid;

use Closure;

class AssignProcessId
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        // Generate a UUID-based process ID
        $processId = Uuid::uuid4()->toString();

        // Bind it to the application container
        app()->instance('process_id', $processId);

        // You can optionally attach it to the request for logging headers, etc.
        $request->attributes->set('process_id', $processId);
        return $next($request);
    }
}
