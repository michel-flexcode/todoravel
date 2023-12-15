<?php

// app/Http/Middleware/SetLocale.php

namespace App\Http\Middleware;

use Closure;

class SetLocale
{
    public function handle($request, Closure $next)
    {
        // Définis la langue en fonction de la session
        app()->setLocale(session('locale', config('app.locale')));

        return $next($request);
    }
}
