<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class NewsAttachment extends Model
{
    protected $fillable = [
        'news_item_id',
        'label',
        'file_path',
        'file_url',
        'mime',
        'size_bytes',
    ];

    public function newsItem(): BelongsTo
    {
        return $this->belongsTo(NewsItem::class);
    }
}
