<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RegionalReport extends Model
{
    protected $fillable = [
        'region_code',
        'region_name',
        'year',
        'status',
        'overall_score',
        'banner_path',
        'summary',
        'body',
        'downloads',
        'created_by',
        'updated_by',
    ];

    public function news(): HasMany
    {
        return $this->hasMany(NewsItem::class, 'region_code', 'region_code');
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
