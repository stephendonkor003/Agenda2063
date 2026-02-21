<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PublicationFile extends Model
{
    protected $fillable = [
        'publication_id',
        'label',
        'file_url',
        'mime_type',
        'size',
    ];

    public function publication(): BelongsTo
    {
        return $this->belongsTo(Publication::class);
    }
}
