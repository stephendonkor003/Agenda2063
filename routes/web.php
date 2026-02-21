<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Setting;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\CampaignController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminUsersController;
use App\Http\Controllers\AdminRolesController;
use App\Http\Controllers\AdminPermissionsController;
use App\Http\Controllers\AdminDepartmentsController;

Route::get('/', [PublicController::class, 'home'])->name('home');
Route::get('/aspirations/{slug}', [PublicController::class, 'aspirationDetail'])->name('aspiration.show');
Route::get('/about', [PublicController::class, 'about'])->name('about');
Route::get('/performance', [PublicController::class, 'performance'])->name('performance');
Route::get('/news', [PublicController::class, 'news'])->name('news');
Route::get('/news/{slug?}', [PublicController::class, 'newsDetail'])->name('news.detail');
Route::get('/news-events', fn() => redirect()->route('news'));
Route::get('/knowledge-base', [PublicController::class, 'knowledgeBase'])->name('knowledge-base');
Route::get('/knowledge/{slug}', [\App\Http\Controllers\KnowledgeDownloadController::class, 'show'])->name('knowledge.download');
Route::get('/flagship-projects', [PublicController::class, 'flagshipProjects'])->name('flagship-projects');
Route::get('/continental-frameworks', [PublicController::class, 'continentalFrameworks'])->name('continental-frameworks');
Route::get('/locale/{locale}', function (string $locale) {
    session(['app_locale' => $locale]);
    app()->setLocale($locale);
    return back();
})->name('locale.switch');

Route::post('/campaign/join', [CampaignController::class, 'store'])->name('campaign.store');
Route::post('/quiz/answer', [QuizController::class, 'store'])->name('quiz.store');

// Auth Routes
Route::get('/login', function (Request $request) {
    if (Auth::check() && Auth::user()->is_admin) {
        return redirect()->route('admin.dashboard');
    }

    return view('auth.login');
})->name('login');

Route::post('/login', function (Request $request) {
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    $maxAttempts = (int) config('auth.login_max_attempts', 5);
    $lockoutMinutes = (int) config('auth.lockout_minutes', 15);
    $lockoutSeconds = max(60, $lockoutMinutes * 60);
    $rateKey = 'login:' . strtolower($credentials['email']) . '|' . $request->ip();

    if (RateLimiter::tooManyAttempts($rateKey, $maxAttempts)) {
        $seconds = RateLimiter::availableIn($rateKey);
        return back()->withErrors([
            'email' => 'Too many login attempts. Try again in ' . ceil($seconds / 60) . ' minutes.',
        ])->onlyInput('email');
    }

    $user = User::where('email', $credentials['email'])->first();
    $remember = $request->boolean('remember');

    // Validate credentials without logging in yet (for 2FA)
    if (! Auth::validate($credentials)) {
        RateLimiter::hit($rateKey, $lockoutSeconds);
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    RateLimiter::clear($rateKey);

    $twoFactorRequired = $user && ($user->two_factor_enabled || Setting::getValue('two_factor', false));

    if ($twoFactorRequired) {
        $code = random_int(100000, 999999);
        Cache::put('2fa:code:' . $user->id, $code, now()->addMinutes(10));
        Cache::put('2fa:remember:' . $user->id, $remember, now()->addMinutes(10));
        session(['2fa:user' => $user->id]);

        try {
            $user->notify(new \App\Notifications\TwoFactorCode($code));
        } catch (\Throwable $e) {
            report($e);
        }

        return redirect()->route('login.2fa')->with('status', 'A verification code was sent to your email.');
    }

    // Proceed with normal login
    Auth::attempt($credentials, $remember);
    $request->session()->regenerate();

    $authUser = Auth::user();

    // Force reset if flagged or platform setting enabled
    if ($authUser->force_password_reset || Setting::getValue('force_password_reset', false)) {
        return redirect()->route('admin.profile')
            ->with('status', 'Please update your password to continue.');
    }

    if ($authUser->is_admin) {
        return redirect()->intended(route('admin.dashboard'));
    }

    Auth::logout();
    return back()->withErrors([
        'email' => 'You do not have admin access.',
    ])->onlyInput('email');
})->middleware('throttle:' . config('auth.login_max_attempts', 5) . ',1')->name('login.submit');

Route::get('/login/2fa', function (Request $request) {
    if (! session()->has('2fa:user')) {
        return redirect()->route('login');
    }
    return view('auth.2fa');
})->name('login.2fa');

Route::post('/login/2fa', function (Request $request) {
    $request->validate([
        'code' => ['required', 'digits:6'],
    ]);

    $userId = session('2fa:user');
    $user = $userId ? User::find($userId) : null;

    if (! $user) {
        return redirect()->route('login')->withErrors(['email' => 'Session expired. Please log in again.']);
    }

    $cachedCode = Cache::get('2fa:code:' . $user->id);
    if ((string) $cachedCode !== $request->input('code')) {
        return back()->withErrors(['code' => 'Invalid or expired verification code.']);
    }

    Cache::forget('2fa:code:' . $user->id);
    $remember = Cache::pull('2fa:remember:' . $user->id, false);
    session()->forget('2fa:user');

    Auth::loginUsingId($user->id, $remember);
    $request->session()->regenerate();

    $authUser = Auth::user();
    if ($authUser->force_password_reset || Setting::getValue('force_password_reset', false)) {
        return redirect()->route('admin.profile')
            ->with('status', 'Please update your password to continue.');
    }

    if ($authUser->is_admin) {
        return redirect()->intended(route('admin.dashboard'));
    }

    Auth::logout();
    return redirect()->route('login')->withErrors(['email' => 'You do not have admin access.']);
})->middleware('throttle:10,1')->name('login.2fa.verify');

Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()->route('login');
})->name('logout');

// Admin Routes
Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'admin', 'idle'])
    ->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::get('/analytics', [\App\Http\Controllers\AdminAnalyticsController::class, 'index'])->name('analytics');
        Route::get('/news', [\App\Http\Controllers\AdminNewsController::class, 'index'])->name('news');
        Route::get('/news/create', [\App\Http\Controllers\AdminNewsController::class, 'create'])->name('news.create');
        Route::get('/news/{news}/edit', [\App\Http\Controllers\AdminNewsController::class, 'edit'])->name('news.edit');
        Route::get('/news/{news}', [\App\Http\Controllers\AdminNewsController::class, 'show'])->name('news.show');
        Route::post('/news', [\App\Http\Controllers\AdminNewsController::class, 'store'])->name('news.store');
        Route::put('/news/{news}', [\App\Http\Controllers\AdminNewsController::class, 'update'])->name('news.update');
        Route::delete('/news/{news}', [\App\Http\Controllers\AdminNewsController::class, 'destroy'])->name('news.destroy');
        // event convenience routes
        Route::get('/events/create', [\App\Http\Controllers\AdminNewsController::class, 'createEvent'])->name('events.create');
        Route::get('/knowledge-base', [\App\Http\Controllers\AdminKnowledgeBaseController::class, 'index'])->name('knowledge-base');
        Route::post('/knowledge-base/categories', [\App\Http\Controllers\AdminKnowledgeBaseController::class, 'storeCategory'])->name('knowledge-base.categories.store');
        Route::put('/knowledge-base/categories/{category}', [\App\Http\Controllers\AdminKnowledgeBaseController::class, 'updateCategory'])->name('knowledge-base.categories.update');
        Route::delete('/knowledge-base/categories/{category}', [\App\Http\Controllers\AdminKnowledgeBaseController::class, 'destroyCategory'])->name('knowledge-base.categories.destroy');
        Route::post('/knowledge-base/documents', [\App\Http\Controllers\AdminKnowledgeBaseController::class, 'storeDocument'])->name('knowledge-base.documents.store');
        Route::put('/knowledge-base/documents/{document}', [\App\Http\Controllers\AdminKnowledgeBaseController::class, 'updateDocument'])->name('knowledge-base.documents.update');
        Route::delete('/knowledge-base/documents/{document}', [\App\Http\Controllers\AdminKnowledgeBaseController::class, 'destroyDocument'])->name('knowledge-base.documents.destroy');
        Route::get('/flagship-projects', [\App\Http\Controllers\AdminFlagshipProjectsController::class, 'index'])->name('flagship-projects');
        Route::get('/flagship-projects/{flagship_project}/edit', [\App\Http\Controllers\AdminFlagshipProjectsController::class, 'editProject'])->name('flagship-projects.edit');
        Route::post('/flagship-projects', [\App\Http\Controllers\AdminFlagshipProjectsController::class, 'storeProject'])->name('flagship-projects.store');
        Route::put('/flagship-projects/{flagship_project}', [\App\Http\Controllers\AdminFlagshipProjectsController::class, 'updateProject'])->name('flagship-projects.update');
        Route::delete('/flagship-projects/{flagship_project}', [\App\Http\Controllers\AdminFlagshipProjectsController::class, 'destroyProject'])->name('flagship-projects.destroy');

        Route::get('/flagship-projects/{flagship_project}/updates/create', [\App\Http\Controllers\AdminFlagshipProjectsController::class, 'createUpdate'])->name('flagship-projects.updates.create');
        Route::post('/flagship-projects/{flagship_project}/updates', [\App\Http\Controllers\AdminFlagshipProjectsController::class, 'storeUpdate'])->name('flagship-projects.updates.store');
        Route::get('/flagship-projects/{flagship_project}/updates/{flagship_update}/edit', [\App\Http\Controllers\AdminFlagshipProjectsController::class, 'editUpdate'])->name('flagship-projects.updates.edit');
        Route::put('/flagship-projects/{flagship_project}/updates/{flagship_update}', [\App\Http\Controllers\AdminFlagshipProjectsController::class, 'updateUpdate'])->name('flagship-projects.updates.update');
        Route::post('/flagship-updates/{flagship_update}/approve', [\App\Http\Controllers\AdminFlagshipProjectsController::class, 'approveUpdate'])->name('flagship-projects.updates.approve');
        Route::post('/flagship-updates/{flagship_update}/reject', [\App\Http\Controllers\AdminFlagshipProjectsController::class, 'rejectUpdate'])->name('flagship-projects.updates.reject');
        Route::delete('/flagship-updates/{flagship_update}', [\App\Http\Controllers\AdminFlagshipProjectsController::class, 'destroyUpdate'])->name('flagship-projects.updates.destroy');
        Route::get('/publications', [\App\Http\Controllers\AdminPublicationsController::class, 'index'])->name('publications');
        Route::post('/publications', [\App\Http\Controllers\AdminPublicationsController::class, 'store'])->name('publications.store');
        Route::put('/publications/{publication}', [\App\Http\Controllers\AdminPublicationsController::class, 'update'])->name('publications.update');
        Route::delete('/publications/{publication}', [\App\Http\Controllers\AdminPublicationsController::class, 'destroy'])->name('publications.destroy');
        Route::post('/publications/{publication}/approve', [\App\Http\Controllers\AdminPublicationsController::class, 'approve'])->name('publications.approve');
        Route::post('/publications/{publication}/reject', [\App\Http\Controllers\AdminPublicationsController::class, 'reject'])->name('publications.reject');
        Route::get('/regional-data', [\App\Http\Controllers\AdminRegionalReportsController::class, 'index'])->name('regional-data');
        Route::post('/regional-data', [\App\Http\Controllers\AdminRegionalReportsController::class, 'store'])->name('regional-data.store');
        Route::put('/regional-data/{regional_report}', [\App\Http\Controllers\AdminRegionalReportsController::class, 'update'])->name('regional-data.update');
        Route::delete('/regional-data/{regional_report}', [\App\Http\Controllers\AdminRegionalReportsController::class, 'destroy'])->name('regional-data.destroy');

        Route::get('/quiz-responses', [\App\Http\Controllers\AdminQuizResponsesController::class, 'index'])->name('quiz-responses');
        Route::get('/campaign-subscribers', [\App\Http\Controllers\AdminCampaignSubscribersController::class, 'index'])->name('campaign-subscribers');
        Route::post('/campaign-subscribers/broadcast', [\App\Http\Controllers\AdminCampaignSubscribersController::class, 'broadcast'])->name('campaign-subscribers.broadcast');
        Route::get('/public-visibility/navigation', [\App\Http\Controllers\AdminPublicVisibilityController::class, 'navigation'])->name('public.nav');
        Route::post('/public-visibility/navigation', [\App\Http\Controllers\AdminPublicVisibilityController::class, 'storeNav'])->name('public.nav.store');
        Route::put('/public-visibility/navigation/{link}', [\App\Http\Controllers\AdminPublicVisibilityController::class, 'updateNav'])->name('public.nav.update');
        Route::delete('/public-visibility/navigation/{link}', [\App\Http\Controllers\AdminPublicVisibilityController::class, 'destroyNav'])->name('public.nav.destroy');
        Route::post('/public-visibility/navigation/reorder', [\App\Http\Controllers\AdminPublicVisibilityController::class, 'reorderNav'])->name('public.nav.reorder');
        Route::get('/public-visibility/navigation/{link}/design', [\App\Http\Controllers\AdminPublicVisibilityController::class, 'designNav'])->name('public.nav.design');
        Route::post('/public-visibility/navigation/{link}/design', [\App\Http\Controllers\AdminPublicVisibilityController::class, 'saveDesignNav'])->name('public.nav.design.save');
        Route::get('/public-visibility/sliders', [\App\Http\Controllers\AdminPublicVisibilityController::class, 'sliders'])->name('public.sliders');
        Route::post('/public-visibility/sliders', [\App\Http\Controllers\AdminPublicVisibilityController::class, 'storeSlider'])->name('public.sliders.store');
        Route::put('/public-visibility/sliders/{slider}', [\App\Http\Controllers\AdminPublicVisibilityController::class, 'updateSlider'])->name('public.sliders.update');
        Route::delete('/public-visibility/sliders/{slider}', [\App\Http\Controllers\AdminPublicVisibilityController::class, 'destroySlider'])->name('public.sliders.destroy');
        Route::post('/public-visibility/sliders/reorder', [\App\Http\Controllers\AdminPublicVisibilityController::class, 'reorderSliders'])->name('public.sliders.reorder');
        Route::get('/public-visibility/footer', [\App\Http\Controllers\AdminPublicVisibilityController::class, 'footers'])->name('public.footer');
        Route::post('/public-visibility/footer', [\App\Http\Controllers\AdminPublicVisibilityController::class, 'storeFooter'])->name('public.footer.store');
        Route::put('/public-visibility/footer/{link}', [\App\Http\Controllers\AdminPublicVisibilityController::class, 'updateFooter'])->name('public.footer.update');
        Route::delete('/public-visibility/footer/{link}', [\App\Http\Controllers\AdminPublicVisibilityController::class, 'destroyFooter'])->name('public.footer.destroy');
        Route::post('/public-visibility/footer/reorder', [\App\Http\Controllers\AdminPublicVisibilityController::class, 'reorderFooter'])->name('public.footer.reorder');
        Route::get('/goals-tracking', [\App\Http\Controllers\GoalsTrackingController::class, 'index'])->name('goals-tracking');
        Route::post('/goals-tracking/sources', [\App\Http\Controllers\GoalsTrackingController::class, 'storeSource'])->name('goals-tracking.sources.store');
        Route::put('/goals-tracking/sources/{source}', [\App\Http\Controllers\GoalsTrackingController::class, 'updateSource'])->name('goals-tracking.sources.update');
        Route::get('/country-reports', [\App\Http\Controllers\AdminCountryReportsController::class, 'index'])->name('country-reports');
        Route::post('/country-reports', [\App\Http\Controllers\AdminCountryReportsController::class, 'store'])->name('country-reports.store');
        Route::put('/country-reports/{country_report}', [\App\Http\Controllers\AdminCountryReportsController::class, 'update'])->name('country-reports.update');
        Route::delete('/country-reports/{country_report}', [\App\Http\Controllers\AdminCountryReportsController::class, 'destroy'])->name('country-reports.destroy');
        Route::get('/users', [AdminUsersController::class, 'index'])->name('users');
        Route::post('/users', [AdminUsersController::class, 'store'])->name('users.store');
        Route::put('/users/{user}', [AdminUsersController::class, 'update'])->name('users.update');
        Route::delete('/users/{user}', [AdminUsersController::class, 'destroy'])->name('users.destroy');
        Route::get('/departments', [AdminDepartmentsController::class, 'index'])->name('departments');
        Route::post('/departments', [AdminDepartmentsController::class, 'store'])->name('departments.store');
        Route::put('/departments/{department}', [AdminDepartmentsController::class, 'update'])->name('departments.update');
        Route::delete('/departments/{department}', [AdminDepartmentsController::class, 'destroy'])->name('departments.destroy');
        Route::get('/roles', [AdminRolesController::class, 'index'])->name('roles');
        Route::post('/roles', [AdminRolesController::class, 'store'])->name('roles.store');
        Route::put('/roles/{role}', [AdminRolesController::class, 'update'])->name('roles.update');
        Route::delete('/roles/{role}', [AdminRolesController::class, 'destroy'])->name('roles.destroy');
        Route::get('/permissions', [AdminPermissionsController::class, 'index'])->name('permissions');
        Route::post('/permissions', [AdminPermissionsController::class, 'store'])->name('permissions.store');
        Route::put('/permissions/{permission}', [AdminPermissionsController::class, 'update'])->name('permissions.update');
        Route::delete('/permissions/{permission}', [AdminPermissionsController::class, 'destroy'])->name('permissions.destroy');
        Route::get('/settings', [AdminController::class, 'settings'])->name('settings');
        Route::put('/settings', [AdminController::class, 'updateSettings'])->name('settings.update');

        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile');
        Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');
    });
