<?php

namespace Modules\Core\Http\Middleware;

use Closure;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role1, $role2 = " ")
    {
        $role = [$role1, $role2];
        if ($request->user()) {
            if (in_array($request->user()->role, $role)) {
                return $next($request);
            }
        }
        return redirect('/');
    }
}
