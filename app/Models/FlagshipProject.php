<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class FlagshipProject extends Model
{
    protected $fillable = [
        'department_id',
        'title',
        'slug',
        'status',
        'progress',
        'image_url',
        'summary',
        'created_by',
        'updated_by',
    ];

    protected static function booted(): void
    {
        static::saving(function (FlagshipProject $p) {
            if (empty($p->slug)) {
                $p->slug = Str::slug($p->title);
            }
        });
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    public function updates(): HasMany
    {
        return $this->hasMany(FlagshipUpdate::class);
    }
}
