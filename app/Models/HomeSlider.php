<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeSlider extends Model
{
    protected $fillable = [
        'title',
        'subtitle',
        'image_url',
        'alt_text',
        'cta_label',
        'cta_url',
        'locale',
        'is_active',
        'position',
        'active',
        'starts_at',
        'ends_at',
    ];
}
