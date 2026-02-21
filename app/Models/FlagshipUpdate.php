<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\User;

class FlagshipUpdate extends Model
{
    protected $fillable = [
        'flagship_project_id',
        'title',
        'type',
        'status',
        'body',
        'published_at',
        'created_by',
        'approved_by',
        'rejected_by',
    ];

    public function project(): BelongsTo
    {
        return $this->belongsTo(FlagshipProject::class, 'flagship_project_id');
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function files(): HasMany
    {
        return $this->hasMany(FlagshipUpdateFile::class);
    }
}
