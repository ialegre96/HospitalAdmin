<?php

namespace App\Http\Middleware;

use App\Models\Module;
use Closure;
use Illuminate\Http\Request;

/**
 * Class CheckModule
 */
class CheckModule
{
    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     *
     * @param  Closure  $next
     *
     * @return mixed
     */
    public function handle($request, $next)
    {
        $route = request()->route()->getName();
        $activeRoutes = Module::whereRoute($route)->whereIsActive(1)->first();
        if (! $activeRoutes) {
            abort(404);
        }

        return $next($request);
    }
}
