<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AnalyticsEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AnalyticsIngestController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'type' => ['required', 'in:pageview,download,quiz,subscription,other'],
            'path' => ['nullable', 'string', 'max:1024'],
            'country' => ['nullable', 'string', 'alpha', 'min:2', 'max:3'],
            'region' => ['nullable', 'string', 'max:64'],
            'duration_seconds' => ['nullable', 'integer', 'min:0', 'max:86400'],
            'meta' => ['nullable', 'array', 'max:20'],
        ]);

        // try enrich country from headers if missing
        if (empty($data['country'])) {
            $headerCountry = $request->header('CF-IPCountry') ?? $request->header('X-Country-Code');
            $data['country'] = $headerCountry ? Str::upper(substr($headerCountry, 0, 3)) : null;
        }

        $meta = collect($data['meta'] ?? [])
            ->mapWithKeys(function ($value, $key) {
                if (! is_scalar($value) && $value !== null) {
                    return [];
                }

                $key = Str::limit((string) $key, 50, '');
                if ($key === '') {
                    return [];
                }

                return [$key => Str::limit((string) $value, 500, '')];
            })
            ->take(20)
            ->all();

        AnalyticsEvent::create([
            ...$data,
            'country' => ! empty($data['country']) ? Str::upper(substr($data['country'], 0, 3)) : null,
            'ip' => $request->ip(),
            'user_agent' => substr($request->userAgent() ?? '', 0, 500),
            'meta' => $meta ?: null,
        ]);

        return response()->json(['status' => 'queued'], 202);
    }
}
