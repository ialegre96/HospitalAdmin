<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckImpersonateUser
{
    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param  Closure  $next
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (session('impersonated_by')) {
            return redirect()->route('dashboard');
        }

        return $next($request);
    }
}
