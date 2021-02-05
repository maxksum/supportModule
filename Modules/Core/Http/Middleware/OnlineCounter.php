<?php

namespace Modules\Core\Http\Middleware;

use Closure;
use Auth;

class OnlineCounter
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
        $response = $next($request);

        if (Auth::check()) {
            Auth::user()->refreshOnline();
        }

        return $response;
    }
}
