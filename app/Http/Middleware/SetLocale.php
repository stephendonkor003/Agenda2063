<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class SetLocale
{
    public function handle(Request $request, Closure $next)
    {
        $supported = ['en','fr','pt','ar'];

        if ($request->has('lang')) {
            $lang = strtolower($request->get('lang'));
            if (in_array($lang, $supported, true)) {
                $request->session()->put('app_locale', $lang);
            }
        }

        $locale = $request->session()->get('app_locale', config('app.locale', 'en'));
        if (! in_array($locale, $supported, true)) {
            $locale = 'en';
        }

        App::setLocale($locale);

        return $next($request);
    }
}
