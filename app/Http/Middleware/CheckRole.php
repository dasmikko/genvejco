<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class CheckRole
{
    /**
     * Run the request filter.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(!Auth::check()) {
            return redirect()->route('dashboardLogin');
        }

        if (Auth::check() && Auth::user()->role > 1) {
            return redirect()->route('home');
        }

        return $next($request);
    }
}
