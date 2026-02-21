<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class KnowledgeDocument extends Model
{
    protected $fillable = [
        'department_id',
        'category_id',
        'title',
        'slug',
        'type',
        'mime',
        'size_bytes',
        'file_path',
        'source_url',
        'status',
        'language',
        'summary',
        'body',
        'downloads',
        'created_by',
        'updated_by',
    ];

    protected static function booted(): void
    {
        static::saving(function (KnowledgeDocument $doc) {
            if (empty($doc->slug)) {
                $doc->slug = Str::slug($doc->title . '-' . now()->timestamp);
            }
        });
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(KnowledgeCategory::class, 'category_id');
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
