<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class NewsItem extends Model
{
    protected $fillable = [
        'department_id',
        'title',
        'slug',
        'type',
        'status',
        'category',
        'summary',
        'body',
        'banner_path',
        'featured',
        'views',
        'published_at',
        'starts_at',
        'ends_at',
        'location',
        'created_by',
        'updated_by',
        'category_id',
        'country_code',
        'region_code',
        'title_translations',
        'summary_translations',
        'body_translations',
    ];

    protected $casts = [
        'featured' => 'bool',
        'published_at' => 'datetime',
        'starts_at' => 'datetime',
        'ends_at' => 'datetime',
        'title_translations' => 'array',
        'summary_translations' => 'array',
        'body_translations' => 'array',
    ];

    protected static function booted(): void
    {
        static::saving(function (NewsItem $item) {
            if (empty($item->slug)) {
                $item->slug = Str::slug($item->title . '-' . now()->timestamp);
            }
        });
    }

    public function attachments(): HasMany
    {
        return $this->hasMany(NewsAttachment::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(NewsCategory::class, 'category_id');
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function localizedTitle(string $locale): string
    {
        return $this->title_translations[$locale] ?? $this->title;
    }

    public function localizedSummary(string $locale): ?string
    {
        return $this->summary_translations[$locale] ?? $this->summary;
    }

    public function localizedBody(string $locale): ?string
    {
        return $this->body_translations[$locale] ?? $this->body;
    }
}
