<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AuditLog extends Model
{
    protected $fillable = [
        'user_id',
        'action',
        'target_type',
        'target_id',
        'meta',
        'ip',
    ];

    protected $casts = [
        'meta' => 'array',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public static function record(string $action, $target = null, $user = null, array $meta = [], ?string $ip = null): void
    {
        static::create([
            'user_id' => $user?->id,
            'action' => $action,
            'target_type' => $target ? get_class($target) : null,
            'target_id' => $target->id ?? null,
            'meta' => $meta ?: null,
            'ip' => $ip,
        ]);
    }
}
