<?php

namespace App\Http\Middleware;

use Closure;

class Localization
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
        $local = ($request->hasHeader('Accept-Language')) ? ($request->header('Accept-Language')) : 'en';
        app()->setLocale($local);

        if (\Session::has('locale')) {
            \App::setLocale(\Session::get('locale'));
        }
        if (\Session::has('lang')) {
            \App::setLocale(\Session::get('lang'));
        }
        return $next($request);
    }
}
