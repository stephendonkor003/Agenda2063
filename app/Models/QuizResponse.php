<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuizResponse extends Model
{
    protected $fillable = [
        'email',
        'slide_number',
        'question',
        'selected_answer',
        'is_correct',
    ];
}
