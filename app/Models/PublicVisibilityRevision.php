<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PublicVisibilityRevision extends Model
{
    protected $fillable = [
        'entity_type',
        'entity_id',
        'user_id',
        'payload',
    ];

    protected $casts = [
        'payload' => 'array',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public static function record(string $type, int $id, array $payload, $user = null): void
    {
        static::create([
            'entity_type' => $type,
            'entity_id' => $id,
            'user_id' => $user?->id,
            'payload' => $payload,
        ]);
    }
}
