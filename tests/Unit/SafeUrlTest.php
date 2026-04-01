<?php

namespace Tests\Unit;

use App\Rules\SafeUrl;
use PHPUnit\Framework\TestCase;

class SafeUrlTest extends TestCase
{
    public function test_it_accepts_https_and_internal_paths(): void
    {
        $this->assertTrue(SafeUrl::isValidValue('https://agenda2063.au.int'));
        $this->assertTrue(SafeUrl::isValidValue('/knowledge/report.pdf', true));
        $this->assertTrue(SafeUrl::isValidValue('#section-1', true));
    }

    public function test_it_rejects_unsafe_schemes_and_protocol_relative_urls(): void
    {
        $this->assertFalse(SafeUrl::isValidValue('javascript:alert(1)', true));
        $this->assertFalse(SafeUrl::isValidValue('data:text/html;base64,PHNjcmlwdD4=', true));
        $this->assertFalse(SafeUrl::isValidValue('//evil.example.com', true));
    }
}
