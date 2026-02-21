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
        'open_in_new_tab',
        'is_active',
        'clicks',
        'page_meta',
    ];

    protected $casts = [
        'page_meta' => 'array',
    ];
}
