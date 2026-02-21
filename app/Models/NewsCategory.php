<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class NewsCategory extends Model
{
    protected $fillable = ['name', 'slug', 'type', 'color'];

    protected static function booted(): void
    {
        static::saving(function (NewsCategory $cat) {
            if (empty($cat->slug)) {
                $cat->slug = Str::slug($cat->name . '-' . $cat->type);
            }
        });
    }

    public function items(): HasMany
    {
        return $this->hasMany(NewsItem::class, 'category_id');
    }
}
