<?php

namespace Database\Seeders;

use App\Models\AnalyticsSession;
use App\Models\AnalyticsEvent;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class AnalyticsDemoSeeder extends Seeder
{
    public function run(): void
    {
        $paths = ['/', '/about', '/news', '/knowledge-base', '/flagship-projects', '/publications'];
        $countries = ['GHA','NGA','KEN','ZAF','EGY','MAR'];

        foreach (range(1, 12) as $i) {
            $session = AnalyticsSession::create([
                'sid' => (string) Str::uuid(),
                'ip' => "102.1.0.$i",
                'user_agent' => 'Demo UA',
                'country' => $countries[array_rand($countries)],
                'first_path' => '/',
                'last_path' => '/news',
                'hits' => 0,
                'total_seconds' => 0,
            ]);

            foreach (range(1, rand(3,6)) as $h) {
                $path = $paths[array_rand($paths)];
                $delta = rand(5,120);
                AnalyticsEvent::create([
                    'session_id' => $session->id,
                    'type' => 'pageview',
                    'path' => $path,
                    'country' => $session->country,
                    'ip' => $session->ip,
                    'duration_seconds' => $delta,
                ]);
                $session->increment('hits');
                $session->total_seconds += $delta;
                $session->last_path = $path;
            }
            $session->save();
        }
    }
}
