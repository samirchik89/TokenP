<?php

namespace App\Http\Middleware;

use Closure;

class CheckInvestor
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
        if(auth()->user() && auth()->user()->user_type != 1){
            return redirect('issuer/token-demo');
        }
        return $next($request);
    }
}
