<?php

namespace CEFE\Http\Middleware;

use Closure;
use Auth;

class SecretaryMiddleware
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
        if(Auth::user()->level == 3) {
            return $next($request);
        }
        abort(404);
    }
}
