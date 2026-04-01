<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NavigationLink extends Model
{
    protected $fillable = [
        'label',
        'url',
        'location',
        'locale',
        'position',
        'parent_id',
        'open_in_new_tab',
        'is_active',
        'clicks',
        'page_meta',
    ];

    protected $casts = [
        'page_meta' => 'array',
    ];

    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(self::class, 'parent_id')->orderBy('position');
    }
}
