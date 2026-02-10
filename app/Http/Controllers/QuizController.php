<?php

namespace App\Http\Controllers;

use App\Models\QuizResponse;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'email'           => 'required|email',
            'name'            => 'nullable|string|max:255',
            'country'         => 'nullable|string|max:255',
            'quiz_type'       => 'nullable|string|in:education,footer',
            'slide_number'    => 'required|integer|min:1|max:20',
            'question'        => 'required|string|max:500',
            'selected_answer' => 'required|string|max:255',
            'is_correct'      => 'required|boolean',
        ]);

        QuizResponse::create($validated);

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Answer recorded!',
            ]);
        }

        return back();
    }
}
