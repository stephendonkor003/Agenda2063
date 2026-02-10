<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\CampaignController;
use App\Http\Controllers\QuizController;

Route::get('/', [PublicController::class, 'home'])->name('home');
Route::get('/about', [PublicController::class, 'about'])->name('about');
Route::get('/performance', [PublicController::class, 'performance'])->name('performance');
Route::get('/news', [PublicController::class, 'news'])->name('news');
Route::get('/news/{slug?}', [PublicController::class, 'newsDetail'])->name('news.detail');
Route::get('/knowledge-base', [PublicController::class, 'knowledgeBase'])->name('knowledge-base');
Route::get('/flagship-projects', [PublicController::class, 'flagshipProjects'])->name('flagship-projects');
Route::get('/continental-frameworks', [PublicController::class, 'continentalFrameworks'])->name('continental-frameworks');

Route::post('/campaign/join', [CampaignController::class, 'store'])->name('campaign.store');
Route::post('/quiz/answer', [QuizController::class, 'store'])->name('quiz.store');

// Auth Routes
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', function () {
    // Placeholder - implement proper auth logic
    return redirect()->route('admin.dashboard');
})->name('login.submit');

// Admin Routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::get('/analytics', function () {
        return view('admin.analytics');
    })->name('analytics');

    Route::get('/news', function () {
        return view('admin.news');
    })->name('news');

    Route::get('/knowledge-base', function () {
        return view('admin.knowledge-base');
    })->name('knowledge-base');

    Route::get('/flagship-projects', function () {
        return view('admin.flagship-projects');
    })->name('flagship-projects');

    Route::get('/publications', function () {
        return view('admin.publications');
    })->name('publications');

    Route::get('/regional-data', function () {
        return view('admin.regional-data');
    })->name('regional-data');

    Route::get('/goals-tracking', function () {
        return view('admin.goals-tracking');
    })->name('goals-tracking');

    Route::get('/country-reports', function () {
        return view('admin.country-reports');
    })->name('country-reports');

    Route::get('/users', function () {
        return view('admin.users');
    })->name('users');

    Route::get('/settings', function () {
        return view('admin.settings');
    })->name('settings');
});
