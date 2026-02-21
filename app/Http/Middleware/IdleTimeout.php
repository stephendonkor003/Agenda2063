<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IdleTimeout
{
    public function handle(Request $request, Closure $next): Response
    {
        $timeout = (int) config('session.timeout', 300);
        $lastActivity = $request->session()->get('last_activity_at');
        $now = now()->timestamp;

        if ($lastActivity && ($now - $lastActivity) >= $timeout) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('login')->with('error', 'You were logged out due to inactivity.');
        }

        $request->session()->put('last_activity_at', $now);

        return $next($request);
    }
}
