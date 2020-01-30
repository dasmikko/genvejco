<?php

namespace App\Http\Middleware;

use Closure;

class UserIsActive
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
        if(!Auth::user()->active) {
            return redirect()->route('home')->with('status-error', 'Du mangler at bekræfte din e-mail.');
        }

        return $next($request);
    }
    }
}
