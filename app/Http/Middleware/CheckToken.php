<?php

namespace App\Http\Middleware;

use Illuminate\Http\Response;
use Closure;
use App\User;

class CheckToken
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
        $apitoken = $request->get('token');

        if(!$apitoken) {
            $result = [
                'status' => 0,
                'message' => 'Token missing',
            ];

            return new Response(json_encode($result));
        }

        $user = User::where('apitoken', $apitoken)->first();

        if($user == null) {
            $result = [
                'status' => 0,
                'message' => 'Invalid token',
            ];

            return new Response(json_encode($result));
        }

        return $next($request);
    }
}
