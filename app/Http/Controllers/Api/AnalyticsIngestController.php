<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AnalyticsEvent;
use Illuminate\Http\Request;

class AnalyticsIngestController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'type' => ['required', 'in:pageview,download,quiz,subscription,other'],
            'path' => ['nullable', 'string', 'max:1024'],
            'country' => ['nullable', 'string', 'max:3'],
            'region' => ['nullable', 'string', 'max:64'],
            'duration_seconds' => ['nullable', 'integer', 'min:0', 'max:86400'],
            'meta' => ['nullable', 'array'],
        ]);

        // try enrich country from headers if missing
        if (empty($data['country'])) {
            $headerCountry = $request->header('CF-IPCountry') ?? $request->header('X-Country-Code');
            $data['country'] = $headerCountry ? substr($headerCountry, 0, 3) : null;
        }

        AnalyticsEvent::create([
            ...$data,
            'ip' => $request->ip(),
            'user_agent' => substr($request->userAgent() ?? '', 0, 500),
        ]);

        return response()->json(['status' => 'queued'], 202);
    }
}
