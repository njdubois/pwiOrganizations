<?php

namespace App\Http\Middleware;

use Closure;

class AuthUser
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
        if (session("loggedUser") == "") {

            abort(401, "Not Authorized.\n\n" . __file__ . " @ Line " . __LINE__);
        }

        return $next($request);
    }
}
