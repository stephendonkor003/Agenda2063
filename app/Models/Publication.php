<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Publication extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'type',
        'language',
        'year',
        'file_url',
        'summary',
        'downloads',
        'department_id',
        'image_url',
        'status',
        'created_by',
        'approved_by',
        'rejected_by',
    ];

    protected static function booted(): void
    {
        static::saving(function (Publication $pub) {
            if (empty($pub->slug)) {
                $pub->slug = Str::slug($pub->title);
            }
        });
    }

    public function files(): HasMany
    {
        return $this->hasMany(PublicationFile::class);
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function approver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function rejector(): BelongsTo
    {
        return $this->belongsTo(User::class, 'rejected_by');
    }
}
