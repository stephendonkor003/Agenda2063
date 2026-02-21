<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AnalyticsEvent extends Model
{
    protected $fillable = [
        'type',
        'path',
        'country',
        'region',
        'ip',
        'user_agent',
        'duration_seconds',
        'meta',
    ];

    protected $casts = [
        'meta' => 'array',
    ];
}
