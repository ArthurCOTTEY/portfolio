<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (session('locale')) {
            app()->setLocale(session('locale'));
            return $next($request);
        }
        $locale = substr($request->server('HTTP_ACCEPT_LANGUAGE'), 0, 2);
        if ($locale === 'fr') {
            app()->setLocale('fr');
        } else {
            app()->setLocale('en');
        }
        app()->setLocale('en');
        return $next($request);
    }
}
