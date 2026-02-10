<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CampaignSignup extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'country',
        'interest',
        'newsletter',
    ];

    protected $casts = [
        'newsletter' => 'boolean',
    ];
}
