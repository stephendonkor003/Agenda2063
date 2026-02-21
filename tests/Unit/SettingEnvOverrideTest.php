<?php

namespace Tests\Unit;

use App\Models\Setting;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SettingEnvOverrideTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function env_value_takes_precedence_over_db_setting()
    {
        // Arrange: DB has a value, env has a different one
        Setting::setValue('platform_name', 'DB Name');
        putenv('APP_NAME=Env Name');

        // Act
        $value = Setting::valueWithEnv('platform_name', 'APP_NAME', 'Default');

        // Assert
        $this->assertEquals('Env Name', $value);
    }

    /** @test */
    public function falls_back_to_db_when_env_absent()
    {
        putenv('APP_NAME'); // clear
        Setting::setValue('platform_name', 'DB Name');

        $value = Setting::valueWithEnv('platform_name', 'APP_NAME', 'Default');

        $this->assertEquals('DB Name', $value);
    }

    /** @test */
    public function falls_back_to_default_when_no_env_or_db()
    {
        putenv('APP_NAME');

        $value = Setting::valueWithEnv('platform_name', 'APP_NAME', 'Default');

        $this->assertEquals('Default', $value);
    }
}
