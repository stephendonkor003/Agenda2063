<?php

namespace App\Http\Controllers;

use App\Models\AnalyticsEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use App\Jobs\AggregateAnalytics;

class AdminAnalyticsController extends Controller
{
    public function index()
    {
        // warm cache asynchronously
        dispatch(new AggregateAnalytics());

        $summary = Cache::get('analytics.summary');
        if (! $summary) {
            $summary = AggregateAnalytics::buildSummary();
            Cache::put('analytics.summary', $summary, now()->addMinutes(5));
        }

        $totals = [
            'visits' => $summary['counts']['pageview'] ?? 0,
            'downloads' => $summary['counts']['download'] ?? 0,
            'avg_time' => $summary['avg_time'] ?? 0,
            'quiz_answers' => $summary['counts']['quiz'] ?? 0,
            'subscriptions' => $summary['counts']['subscription'] ?? 0,
        ];

        return view('admin.analytics', [
            'totals' => $totals,
            'topCountries' => $summary['topCountries'],
            'topPages' => $summary['topPages'],
            'recentDownloads' => $summary['downloads'],
            'quizRecent' => $summary['quizRecent'],
            'subsRecent' => $summary['subsRecent'],
            'updatedAt' => $summary['updated_at'],
        ]);

    }
}
