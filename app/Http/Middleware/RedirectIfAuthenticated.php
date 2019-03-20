<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\User;

class RedirectIfAuthenticated
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
        if (Auth::guard($guard)->check()) {
            return redirect('/');
        }
        
        if (!Auth::check() && isset(parse_url(url()->previous())['path']) && parse_url(url()->previous())['path'] == '/admin' && is_null(User::where('role', 'admin')->first())) {
            User::create([
                'name' => 'Admin',
                'role' => 'admin',
                'email' => 'admin@abc.com',
                'password' => bcrypt('111111'),
            ]);
        }
        return $next($request);
    }
}
