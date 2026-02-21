<?php

namespace App\Http\Controllers;

use App\Models\QuizResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminQuizResponsesController extends Controller
{
    public function index()
    {
        $stats = [
            'total' => QuizResponse::count(),
            'correct_pct' => round((QuizResponse::where('is_correct', true)->count() / max(1, QuizResponse::count())) * 100, 1),
        ];

        $bySlide = QuizResponse::select('slide_number', DB::raw('count(*) as total'), DB::raw('sum(is_correct) as correct'))
            ->groupBy('slide_number')
            ->orderBy('slide_number')
            ->get();

        $topQuestions = QuizResponse::select('question', DB::raw('count(*) as total'))
            ->groupBy('question')
            ->orderByDesc('total')
            ->limit(5)
            ->get();

        $recent = QuizResponse::latest()->limit(25)->get();

        return view('admin.quiz-responses', compact('stats', 'bySlide', 'topQuestions', 'recent'));
    }
}
