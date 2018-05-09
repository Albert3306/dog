<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

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
        switch ($guard) {
            case 'web':
                $home_url = '/index';
                break;
            case 'admin':
                $home_url = '/admin/index';
                break;
        }

        if (Auth::guard($guard)->check()) {
            return redirect($home_url);
        }

        return $next($request);
    }
}
