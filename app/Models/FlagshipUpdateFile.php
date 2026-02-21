<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FlagshipUpdateFile extends Model
{
    protected $fillable = [
        'flagship_update_id',
        'label',
        'file_url',
        'mime_type',
        'size',
    ];

    public function flagshipUpdate(): BelongsTo
    {
        return $this->belongsTo(FlagshipUpdate::class, 'flagship_update_id');
    }
}
