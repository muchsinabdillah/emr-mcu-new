<?php

namespace App\Http\Middleware;

use Closure;

class Authorize
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @param string $acl
     * @return mixed|\Illuminate\Http\Response
     */
    public function handle($request, Closure $next, $role)
    {
        if (! \App\Http\Controllers\AuthController::is($role)) {

            return redirect('main');
        }
 
        return $next($request);
    }
}
