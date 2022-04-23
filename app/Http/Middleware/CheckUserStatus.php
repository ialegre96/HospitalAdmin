<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Flash;

class CheckUserStatus
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
        $response = $next($request);

        if (Auth::check() && ! $request->user()->status) {
            Auth::logout();
            Flash::error('Your Account is currently disabled, please contact to administrator.');

            return redirect()->back();
        }

        return $response;
    }
}
