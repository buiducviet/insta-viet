<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class Backend
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (!in_array(Auth::user()->role, ['admin', 'mod'])) {
            return redirect('/');
        }

        return $next($request);
    }
}
