<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SetLanguage
{
    /**
     * use Illuminate\Support\Facades\Session;
     *
     * @param  \Request  $request
     * @param  Closure  $next
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $localeLanguage = \Session::get('languageName');

        if (! isset($localeLanguage)) {
            \App::setLocale('en');
        } else {
            \App::setLocale($localeLanguage);
        }

        return $next($request);
    }
}
