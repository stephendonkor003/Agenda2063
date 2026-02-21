<?php

namespace App\Console\Commands;

use App\Mail\PlatformStatusMail;
use App\Models\AnalyticsEvent;
use App\Models\AnalyticsSession;
use App\Models\CampaignSignup;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class SendPlatformStatusReport extends Command
{
    protected $signature   = 'platform:status-report';
    protected $description = 'Send a platform health & analytics status report to all admin users';

    public function handle(): int
    {
        $data  = $this->collectData();
        $users = User::whereNotNull('email')->get();

        if ($users->isEmpty()) {
            $this->warn('No users found — report not sent.');
            return self::SUCCESS;
        }

        foreach ($users as $user) {
            Mail::to($user->email, $user->name)->send(new PlatformStatusMail($data));
        }

        $this->info("Platform status report sent to {$users->count()} user(s).");
        return self::SUCCESS;
    }

    private function collectData(): array
    {
        $since   = now()->subHours(5);
        $sinceTs = $since->toDateTimeString();

        // ── Analytics ─────────────────────────────────────────────────────────
        $pageviewsPeriod  = AnalyticsEvent::where('type', 'pageview')->where('created_at', '>=', $sinceTs)->count();
        $sessionsPeriod   = AnalyticsSession::where('created_at', '>=', $sinceTs)->count();
        $allTimePageviews = AnalyticsEvent::where('type', 'pageview')->count();
        $allTimeSessions  = AnalyticsSession::count();

        $avgSeconds = (int) round(
            AnalyticsSession::where('created_at', '>=', $sinceTs)->where('total_seconds', '>', 0)->avg('total_seconds') ?? 0
        );

        $eventBreakdown = AnalyticsEvent::select('type', DB::raw('count(*) as total'))
            ->where('created_at', '>=', $sinceTs)
            ->groupBy('type')
            ->get()
            ->pluck('total', 'type');

        // ── Top countries (last 5 h) ──────────────────────────────────────────
        $topCountries = AnalyticsSession::select('country', DB::raw('count(*) as visits'))
            ->where('created_at', '>=', $sinceTs)
            ->whereNotNull('country')
            ->where('country', '!=', '')
            ->groupBy('country')
            ->orderByDesc('visits')
            ->limit(10)
            ->get();

        // ── Top pages (last 5 h) ──────────────────────────────────────────────
        $topPages = AnalyticsEvent::select('path', DB::raw('count(*) as views'))
            ->where('type', 'pageview')
            ->where('created_at', '>=', $sinceTs)
            ->groupBy('path')
            ->orderByDesc('views')
            ->limit(10)
            ->get();

        // ── Campaign signups ──────────────────────────────────────────────────
        $newSignups      = CampaignSignup::where('created_at', '>=', $sinceTs)->count();
        $totalSubscribers = CampaignSignup::count();

        // ── Queue & failures ──────────────────────────────────────────────────
        $pendingJobs = DB::table('jobs')->count();
        $failedJobs  = DB::table('failed_jobs')->count();

        $recentFailed = DB::table('failed_jobs')
            ->select('id', 'queue', 'payload', 'exception', 'failed_at')
            ->orderByDesc('failed_at')
            ->limit(5)
            ->get()
            ->map(function ($row) {
                $payload = json_decode($row->payload, true);
                return [
                    'id'         => $row->id,
                    'queue'      => $row->queue,
                    'job'        => class_basename($payload['displayName'] ?? 'Unknown'),
                    'failed_at'  => $row->failed_at,
                    'exception'  => substr($row->exception ?? '', 0, 200),
                ];
            });

        // ── Server health ─────────────────────────────────────────────────────
        $diskBase  = function_exists('disk_total_space') ? base_path() : null;
        $diskTotal = $diskBase ? @disk_total_space($diskBase) : 0;
        $diskFree  = $diskBase ? @disk_free_space($diskBase)  : 0;
        $diskUsed  = max(0, $diskTotal - $diskFree);
        $diskPct   = $diskTotal > 0 ? round(($diskUsed / $diskTotal) * 100, 1) : 0;

        // ── Users ─────────────────────────────────────────────────────────────
        $totalUsers  = User::count();
        $activeUsers = User::where('updated_at', '>=', $sinceTs)->count();

        return [
            'period_hours'    => 5,
            'generated_at'    => now(),
            'analytics'       => [
                'pageviews_period'   => $pageviewsPeriod,
                'sessions_period'    => $sessionsPeriod,
                'all_time_pageviews' => $allTimePageviews,
                'all_time_sessions'  => $allTimeSessions,
                'avg_session_seconds'=> $avgSeconds,
                'downloads'          => $eventBreakdown->get('download', 0),
                'subscriptions'      => $eventBreakdown->get('subscription', 0),
                'quiz_interactions'  => $eventBreakdown->get('quiz', 0),
            ],
            'top_countries'   => $topCountries,
            'top_pages'       => $topPages,
            'subscribers'     => [
                'new_period'  => $newSignups,
                'total'       => $totalSubscribers,
            ],
            'queue'           => [
                'pending_jobs'  => $pendingJobs,
                'failed_jobs'   => $failedJobs,
                'recent_failed' => $recentFailed,
            ],
            'server'          => [
                'php_version'  => PHP_VERSION,
                'disk_total'   => $diskTotal,
                'disk_free'    => $diskFree,
                'disk_used_pct'=> $diskPct,
                'memory_limit' => ini_get('memory_limit'),
                'app_env'      => config('app.env'),
                'app_url'      => config('app.url'),
            ],
            'users'           => [
                'total'         => $totalUsers,
                'active_period' => $activeUsers,
            ],
        ];
    }
}
