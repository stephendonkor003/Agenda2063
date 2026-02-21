<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class KnowledgeCategory extends Model
{
    protected $fillable = ['name', 'slug', 'color', 'description'];

    protected static function booted(): void
    {
        static::saving(function (KnowledgeCategory $cat) {
            if (empty($cat->slug)) {
                $cat->slug = Str::slug($cat->name);
            }
        });
    }

    public function documents(): HasMany
    {
        return $this->hasMany(KnowledgeDocument::class, 'category_id');
    }
}
