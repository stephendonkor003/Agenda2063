<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ExternalDataSource extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'provider',
        'type',
        'base_url',
        'auth_type',
        'api_key',
        'auth_header',
        'status',
        'last_synced_at',
        'sync_frequency',
        'mapping',
        'notes',
    ];

    protected $casts = [
        'mapping' => 'array',
        'last_synced_at' => 'datetime',
    ];

    protected static function booted(): void
    {
        static::saving(function (ExternalDataSource $src) {
            if (empty($src->slug)) {
                $src->slug = Str::slug($src->name);
            }
        });
    }
}
