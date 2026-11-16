<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        if ($this->app->isProduction()) {
            URL::forceScheme('https');
        }

        // Anti-spam : 5 messages toutes les 10 minutes par adresse IP.
        RateLimiter::for('contact', fn (Request $request) => Limit::perMinutes(10, 5)
            ->by($request->ip())
            ->response(fn () => response()->json([
                'message' => 'Vous avez envoyé plusieurs messages en peu de temps. Merci de réessayer dans quelques minutes.',
            ], 429)));
    }
}
