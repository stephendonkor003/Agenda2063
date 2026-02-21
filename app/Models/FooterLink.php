<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FooterLink extends Model
{
    protected $fillable = [
        'label',
        'url',
        'section',
        'locale',
        'position',
        'open_in_new_tab',
        'is_active',
        'clicks',
    ];
}
