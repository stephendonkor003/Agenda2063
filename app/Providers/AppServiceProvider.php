<?php

namespace App\Providers;

use App\Models\User;
use App\Models\Setting;
use App\Models\NavigationLink;
use App\Models\FooterLink;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::before(function (User $user) {
            return $user->is_admin ? true : null;
        });

        Gate::define('manage-users', function (User $user) {
            return $user->canDo('manage-users');
        });

        Gate::define('view-all-departments', function (User $user) {
            return $user->canDo('view-all-departments');
        });

        // Share navigation / footer links with all public views (guard against missing tables during fresh installs)
        if (Schema::hasTable('navigation_links')) {
            view()->composer('partials.navigation', function ($view) {
                $view->with(
                    'navLinks',
                    NavigationLink::query()
                        ->where('is_active', true)
                        ->where('locale', app()->getLocale())
                        ->where('location', 'header')
                        ->orderBy('position')
                        ->get()
                );
            });
        } else {
            view()->composer('partials.navigation', fn ($view) => $view->with('navLinks', collect()));
        }

        if (Schema::hasTable('footer_links')) {
            view()->composer('partials.footer', function ($view) {
                $footerLinks = FooterLink::query()
                    ->where('is_active', true)
                    ->where('locale', app()->getLocale())
                    ->orderBy('section')
                    ->orderBy('position')
                    ->get()
                    ->groupBy('section');

                $view->with('footerLinks', $footerLinks);
            });
        } else {
            view()->composer('partials.footer', fn ($view) => $view->with('footerLinks', collect()));
        }

        // Apply persisted settings to runtime config (app name, timezone, mail, security) only when the table exists
        $settings = collect();
        if (Schema::hasTable('settings')) {
            $settings = Setting::query()->pluck('value', 'key');

            $appName = env('APP_NAME') ?: ($settings['platform_name'] ?? null);
            if ($appName) {
                config(['app.name' => $appName]);
            }

            if ($settings->has('timezone')) {
                $tz = $settings['timezone'];
                config(['app.timezone' => $tz]);
                @date_default_timezone_set($tz);
            }

            $fromEmail = env('MAIL_FROM_ADDRESS') ?: ($settings['contact_email'] ?? null);
            if ($fromEmail) {
                config(['mail.from.address' => $fromEmail]);
            }

            $sessionTimeout = (int) ($settings['session_timeout'] ?? 300);
            config(['session.timeout' => max(60, $sessionTimeout)]);
            config([
                'auth.login_max_attempts' => (int) (env('LOGIN_MAX_ATTEMPTS') ?: ($settings['max_login_attempts'] ?? 5)),
                'auth.lockout_minutes' => (int) (env('LOGIN_LOCKOUT_MINUTES') ?: ($settings['lockout_minutes'] ?? 15)),
            ]);

            config([
                'mail.mailers.smtp.host' => env('MAIL_HOST') ?: ($settings['smtp_host'] ?? config('mail.mailers.smtp.host')),
                'mail.mailers.smtp.port' => env('MAIL_PORT') ?: ($settings['smtp_port'] ?? config('mail.mailers.smtp.port')),
                'mail.mailers.smtp.username' => env('MAIL_USERNAME') ?: ($settings['smtp_username'] ?? config('mail.mailers.smtp.username')),
                'mail.mailers.smtp.password' => env('MAIL_PASSWORD') ?: ($settings['smtp_password'] ?? config('mail.mailers.smtp.password')),
                'mail.mailers.smtp.encryption' => env('MAIL_ENCRYPTION') ?: (isset($settings['smtp_encryption']) && $settings['smtp_encryption'] !== 'None'
                    ? strtolower($settings['smtp_encryption'])
                    : null),
            ]);
        }
    }
}
