<?php

namespace App\Http\Middleware;

use App\Models\AnalyticsEvent;
use App\Models\AnalyticsSession;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TrackPublicAnalytics
{
    public function handle(Request $request, Closure $next)
    {
        // Skip admin and API routes
        if ($request->is('admin/*') || $request->is('api/*')) {
            return $next($request);
        }

        $response = $next($request);

        // Only track GET/POST public pages
        if (! in_array($request->method(), ['GET','POST'])) {
            return $response;
        }

        try {
            $sessionId = $request->session()->get('analytics_sid');
            $now = now();

            // create or load session
            $session = null;
            if ($sessionId) {
                $session = AnalyticsSession::where('sid', $sessionId)->first();
            }
            if (! $session) {
                $session = AnalyticsSession::create([
                    'ip' => $request->ip(),
                    'user_agent' => substr($request->userAgent() ?? '', 0, 500),
                    'country' => $this->detectCountry($request),
                    'first_path' => $request->path(),
                    'last_path' => $request->path(),
                    'hits' => 0,
                ]);
                $request->session()->put('analytics_sid', $session->sid);
                $request->session()->put('analytics_last', $now->timestamp);
            }

            $lastTs = $request->session()->get('analytics_last', $now->timestamp);
            $delta = max(0, $now->timestamp - $lastTs);
            $request->session()->put('analytics_last', $now->timestamp);

            // update session summary
            $session->increment('hits');
            $session->last_path = $request->path();
            $session->country = $session->country ?: $this->detectCountry($request);
            $session->total_seconds = $session->total_seconds + $delta;
            $session->save();

            // classify event type
            $type = 'pageview';
            if ($this->looksLikeDownload($request->path())) {
                $type = 'download';
            } elseif ($request->is('quiz*') && $request->isMethod('post')) {
                $type = 'quiz';
            } elseif ($this->isSubscription($request)) {
                $type = 'subscription';
            }

            $meta = [];
            if ($type === 'quiz') {
                $meta = [
                    'name' => $request->input('first_name') ?? $request->input('name'),
                    'email' => $request->input('email'),
                ];
            }

            AnalyticsEvent::create([
                'session_id' => $session->id,
                'type' => $type,
                'path' => $request->path(),
                'country' => $session->country,
                'region' => $session->region,
                'ip' => $request->ip(),
                'user_agent' => substr($request->userAgent() ?? '', 0, 500),
                'duration_seconds' => $delta,
                'meta' => $meta ?: null,
            ]);
        } catch (\Throwable $e) {
            // Analytics should never break the public site; log and continue
            report($e);
        }

        return $response;
    }

    protected function looksLikeDownload(string $path): bool
    {
        return preg_match('/\\.(pdf|docx?|xlsx?|pptx?|zip)$/i', $path) === 1;
    }

    protected function isSubscription(Request $request): bool
    {
        return $request->isMethod('post') && ($request->is('subscribe') || $request->is('newsletter*'));
    }

    protected function detectCountry(Request $request): ?string
    {
        $headerCountry = $request->header('CF-IPCountry') ?? $request->header('X-Country-Code');
        if ($headerCountry) return substr($headerCountry, 0, 3);
        // fallback: leave null (no local geo DB available)
        return null;
    }
}
