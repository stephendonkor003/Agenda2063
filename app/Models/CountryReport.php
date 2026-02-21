<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CountryReport extends Model
{
    protected $fillable = [
        'country_code',
        'country_name',
        'region',
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
        return $this->hasMany(NewsItem::class, 'country_code', 'country_code');
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
