<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class LanguageChangeMiddleware
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
        $localeLanguage = \Session::get('languageChangeName');

        if (! isset($localeLanguage)) {
            \App::setLocale('en');
        } else {
            \App::setLocale($localeLanguage);
        }
        
        return $next($request);
    }
}
