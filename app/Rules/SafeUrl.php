<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class SafeUrl implements ValidationRule
{
    public function __construct(
        private readonly bool $allowRelative = false,
    ) {
    }

    public static function isValidValue(?string $value, bool $allowRelative = false): bool
    {
        if ($value === null || $value === '') {
            return true;
        }

        $value = trim($value);

        if ($allowRelative && (str_starts_with($value, '/') || str_starts_with($value, '#'))) {
            return ! str_starts_with($value, '//');
        }

        if (! filter_var($value, FILTER_VALIDATE_URL)) {
            return false;
        }

        $scheme = strtolower((string) parse_url($value, PHP_URL_SCHEME));

        return in_array($scheme, ['http', 'https'], true);
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (! is_string($value) && $value !== null) {
            $fail('The :attribute field must be a valid URL.');

            return;
        }

        if (! self::isValidValue($value, $this->allowRelative)) {
            $fail('The :attribute field must use an http(s) URL or an internal path.');
        }
    }
}
