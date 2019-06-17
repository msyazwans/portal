<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $permitRole)
    {
        if (Auth::check()) {
            $accessPower = Auth::user()->access_power;

            $permitPower = [
                'admin' => 400,
                'super' => 500
            ];

            if ($accessPower >= $permitPower[$permitRole]) {
                return $next($request);

            } else {
                return redirect('/login')->with('errorMessage','You have to login first');

            }

        } else {
            return redirect('/login')->with('errorMessage','You have to login first');
        }
    }
}
