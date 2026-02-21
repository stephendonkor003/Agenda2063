<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class AnalyticsSession extends Model
{
    protected $fillable = [
        'sid',
        'ip',
        'user_agent',
        'country',
        'region',
        'first_path',
        'last_path',
        'hits',
        'total_seconds',
    ];

    protected static function booted(): void
    {
        static::creating(function (AnalyticsSession $s) {
            if (empty($s->sid)) {
                $s->sid = (string) Str::uuid();
            }
        });
    }

    public function events(): HasMany
    {
        return $this->hasMany(AnalyticsEvent::class, 'session_id');
    }
}
