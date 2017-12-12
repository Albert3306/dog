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
        $backend_home_url = config('site.route.prefix.admin', 'admin').'/index';
        $desktop_home_url = config('site.route.prefix.desktop', '').'/i/welcome.html';
        switch ($guard) {
            case 'admin':
                $site = 'web';
                $home_url = $backend_home_url;
                break;
            case 'desktop':
            default:
                $site = 'member';
                $home_url = $desktop_home_url;
                break;
        }
        if (Auth::guard($site)->check()) {
            return redirect($home_url);
        }

        return $next($request);
    }
}
