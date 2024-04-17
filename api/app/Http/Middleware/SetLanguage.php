<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SetLanguage
{
    public function handle(Request $request, Closure $next)
    {
        $locale = $request->route('lang');
        app()->setLocale($locale);

        return $next($request);
    }
}
