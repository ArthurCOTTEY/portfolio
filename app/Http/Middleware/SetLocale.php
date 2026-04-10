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
    public function handle($request, Closure $next)
    {
        $locale = $request->segment(1);

        if (!in_array($locale, ['fr', 'en'])) {
            $locale = session('locale')
                ?? $request->getPreferredLanguage(['fr', 'en'])
                ?? 'en';

            return redirect("/$locale");
        }

        app()->setLocale($locale);
        session(['locale' => $locale]);

        return $next($request);
    }
}
