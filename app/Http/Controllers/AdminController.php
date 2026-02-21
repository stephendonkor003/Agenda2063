<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\CountryReport;
use App\Models\RegionalReport;
use App\Models\ExternalDataSource;
use App\Models\NewsItem;
use App\Models\Publication;
use App\Models\KnowledgeDocument;
use App\Models\AnalyticsEvent;
use Illuminate\Support\Facades\Cache;
use App\Jobs\AggregateAnalytics;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Trigger analytics aggregation
        dispatch(new AggregateAnalytics());
        $summary = Cache::get('analytics.summary') ?? AggregateAnalytics::buildSummary();

        $user = request()->user();
        $canViewAll = $user?->canDo('view-all-departments');

        $newsQuery = $canViewAll ? NewsItem::query() : NewsItem::where('department_id', $user?->department_id);
        $pubQuery = $canViewAll ? Publication::query() : Publication::where('department_id', $user?->department_id);
        $knowledgeQuery = $canViewAll ? KnowledgeDocument::query() : KnowledgeDocument::where('department_id', $user?->department_id);

        $counts = [
            'news' => $newsQuery->count(),
            'publications' => $pubQuery->count(),
            'knowledge' => $knowledgeQuery->count(),
            'country_reports' => CountryReport::count(),
            'regional_reports' => RegionalReport::count(),
            'visits' => $summary['counts']['pageview'] ?? 0,
            'downloads' => $summary['counts']['download'] ?? 0,
            'subscriptions' => $summary['counts']['subscription'] ?? 0,
            'quiz' => $summary['counts']['quiz'] ?? 0,
            'avg_time' => $summary['avg_time'] ?? 0,
        ];

        $topPages = $summary['topPages'];
        $topCountries = $summary['topCountries'];
        $recentDownloads = $summary['downloads'];

        $latestNews = $newsQuery->latest()->take(5)->get();
        $latestPubs = $pubQuery->latest()->take(5)->get();
        $sources = ExternalDataSource::latest()->take(4)->get();

        return view('admin.dashboard', compact('counts', 'topPages', 'topCountries', 'recentDownloads', 'latestNews', 'latestPubs', 'sources'));
    }

    public function analytics()
    {
        return view('admin.analytics');
    }

    public function news()
    {
        return view('admin.news');
    }

    public function regionalData()
    {
        return view('admin.regional-data');
    }

    public function countryReports()
    {
        return view('admin.country-reports');
    }

    public function settings()
    {
        $settings = [
            'platform_name' => Setting::valueWithEnv('platform_name', 'APP_NAME', 'Agenda 2063 Platform'),
            'platform_description' => Setting::valueWithEnv('platform_description', 'PLATFORM_DESCRIPTION', "The official knowledge and monitoring platform for the African Union's Agenda 2063 - The Africa We Want."),
            'contact_email' => Setting::valueWithEnv('contact_email', 'MAIL_FROM_ADDRESS', 'info@agenda2063.africa'),
            'default_language' => Setting::getValue('default_language', 'English'),
            'timezone' => Setting::valueWithEnv('timezone', 'APP_TIMEZONE', 'Africa/Addis_Ababa'),
            'items_per_page' => (int) Setting::getValue('items_per_page', 20),
            'admin_theme' => Setting::getValue('admin_theme', 'light'),
            'primary_color' => Setting::getValue('primary_color', '#822b39'),
            'sidebar_compact' => (bool) Setting::getValue('sidebar_compact', false),
            'animations' => (bool) Setting::getValue('animations', true),
            'smtp_host' => Setting::getValue('smtp_host', ''),
            'smtp_port' => Setting::getValue('smtp_port', ''),
            'smtp_username' => Setting::getValue('smtp_username', ''),
            'smtp_password' => Setting::getValue('smtp_password', ''),
            'smtp_encryption' => Setting::getValue('smtp_encryption', 'tls'),
            'email_notifications' => (bool) Setting::getValue('email_notifications', true),
            'two_factor' => (bool) Setting::getValue('two_factor', false),
            'force_password_reset' => (bool) Setting::getValue('force_password_reset', false),
            'session_timeout' => (int) Setting::getValue('session_timeout', 300),
            'max_login_attempts' => (int) Setting::getValue('max_login_attempts', 5),
            'lockout_minutes' => (int) Setting::getValue('lockout_minutes', 15),
            'ip_whitelist_enabled' => (bool) Setting::getValue('ip_whitelist_enabled', false),
            'ip_whitelist' => Setting::getValue('ip_whitelist', ''),
            'auto_backups' => (bool) Setting::getValue('auto_backups', false),
            'backup_frequency' => Setting::getValue('backup_frequency', 'weekly'),
            'retention_period' => Setting::getValue('retention_period', '90d'),
            'backup_location' => Setting::getValue('backup_location', 'local'),
        ];

        return view('admin.settings', compact('settings'));
    }

    public function updateSettings(Request $request)
    {
        $data = $request->validate([
            'platform_name' => ['required', 'string', 'max:255'],
            'platform_description' => ['nullable', 'string'],
            'contact_email' => ['required', 'email'],
            'default_language' => ['required', 'string', 'max:50'],
            'timezone' => ['required', 'string', 'max:100'],
            'items_per_page' => ['required', 'integer', 'min:5', 'max:200'],
            'admin_theme' => ['required', 'in:light,dark'],
            'primary_color' => ['required', 'string', 'max:20'],
            'sidebar_compact' => ['sometimes', 'boolean'],
            'animations' => ['sometimes', 'boolean'],
            'smtp_host' => ['nullable', 'string', 'max:255'],
            'smtp_port' => ['nullable', 'string', 'max:10'],
            'smtp_username' => ['nullable', 'string', 'max:255'],
            'smtp_password' => ['nullable', 'string', 'max:255'],
            'smtp_encryption' => ['nullable', 'in:tls,ssl,none'],
            'email_notifications' => ['sometimes', 'boolean'],
            'two_factor' => ['sometimes', 'boolean'],
            'force_password_reset' => ['sometimes', 'boolean'],
            'session_timeout' => ['required', 'integer', 'min:60', 'max:7200'],
            'max_login_attempts' => ['required', 'integer', 'min:3', 'max:10'],
            'lockout_minutes' => ['required', 'integer', 'min:1', 'max:60'],
            'ip_whitelist_enabled' => ['sometimes', 'boolean'],
            'ip_whitelist' => ['nullable', 'string'],
            'auto_backups' => ['sometimes', 'boolean'],
            'backup_frequency' => ['nullable', 'in:daily,weekly,monthly,12h'],
            'retention_period' => ['nullable', 'in:7d,30d,90d,180d,365d'],
            'backup_location' => ['nullable', 'in:local,s3,gcs,sftp'],
        ]);

        // normalize checkboxes/toggles so un-checked boxes persist as false
        $booleanKeys = [
            'sidebar_compact',
            'animations',
            'email_notifications',
            'two_factor',
            'force_password_reset',
            'ip_whitelist_enabled',
            'auto_backups',
        ];

        foreach ($booleanKeys as $key) {
            $data[$key] = $request->boolean($key);
        }

        foreach ($data as $key => $value) {
            Setting::setValue($key, $value ?? '');
        }

        return back()->with('status', 'Settings updated.');
    }
}
