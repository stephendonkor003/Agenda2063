<?php

namespace App\Jobs;

use App\Models\AnalyticsEvent;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class AggregateAnalytics implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle(): void
    {
        Cache::put('analytics.summary', self::buildSummary(), now()->addMinutes(5));
    }

    public static function buildSummary(): array
    {
        $types = ['pageview','download','quiz','subscription'];
        $counts = [];
        foreach ($types as $t) {
            $counts[$t] = AnalyticsEvent::where('type', $t)->count();
        }
        $avgTime = round(AnalyticsEvent::where('type','pageview')->avg('duration_seconds') ?? 0);

        $topCountries = AnalyticsEvent::select('country', DB::raw('count(*) as hits'))
            ->whereNotNull('country')
            ->groupBy('country')
            ->orderByDesc('hits')
            ->limit(8)
            ->get();

        $topPages = AnalyticsEvent::select('path', DB::raw('count(*) as hits'))
            ->where('type', 'pageview')
            ->whereNotNull('path')
            ->groupBy('path')
            ->orderByDesc('hits')
            ->limit(8)
            ->get();

        $downloads = AnalyticsEvent::where('type','download')->latest()->limit(10)->get();
        $quizRecent = AnalyticsEvent::where('type','quiz')->latest()->limit(10)->get();
        $subsRecent = AnalyticsEvent::where('type','subscription')->latest()->limit(10)->get();

        return [
            'counts' => $counts,
            'avg_time' => $avgTime,
            'topCountries' => $topCountries,
            'topPages' => $topPages,
            'downloads' => $downloads,
            'quizRecent' => $quizRecent,
            'subsRecent' => $subsRecent,
            'updated_at' => now(),
        ];
    }
}
