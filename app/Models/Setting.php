<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = ['key', 'value'];

    protected $casts = [
        'value' => 'array',
    ];

    public static function getValue(string $key, $default = null)
    {
        $setting = static::query()->where('key', $key)->first();

        return $setting?->value ?? $default;
    }

    /**
     * Prefer an environment variable when present, otherwise fall back to stored setting.
     */
    public static function valueWithEnv(string $key, string $envKey, $default = null)
    {
        $envVal = env($envKey);
        if ($envVal !== null && $envVal !== '') {
            return $envVal;
        }
        return static::getValue($key, $default);
    }

    public static function setValue(string $key, $value): void
    {
        static::query()->updateOrCreate(
            ['key' => $key],
            ['value' => $value]
        );
    }
}
