<?php

namespace App\Http\Middleware;

use Closure;

class CheckAccess
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
        $access = \Accessibility::get('id'); // id's array
        $userRole = \Auth::user()->roleId; // user's roleId
        $roleAccess = \Role::get('accessibility'); //access of each role
        
        return $next($request);
    }
}
