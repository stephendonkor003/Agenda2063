<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('navigation_links', function (Blueprint $table) {
            $table->string('locale', 10)->default('en')->after('location');
            $table->boolean('is_active')->default(true)->after('locale');
            $table->unsignedBigInteger('clicks')->default(0)->after('open_in_new_tab');
        });

        Schema::table('footer_links', function (Blueprint $table) {
            $table->string('locale', 10)->default('en')->after('section');
            $table->boolean('is_active')->default(true)->after('locale');
            $table->unsignedBigInteger('clicks')->default(0)->after('open_in_new_tab');
        });

        Schema::table('home_sliders', function (Blueprint $table) {
            $table->string('locale', 10)->default('en')->after('cta_url');
            $table->boolean('is_active')->default(true)->after('locale');
        });
    }

    public function down(): void
    {
        Schema::table('navigation_links', function (Blueprint $table) {
            $table->dropColumn(['locale', 'is_active', 'clicks']);
        });
        Schema::table('footer_links', function (Blueprint $table) {
            $table->dropColumn(['locale', 'is_active', 'clicks']);
        });
        Schema::table('home_sliders', function (Blueprint $table) {
            $table->dropColumn(['locale', 'is_active']);
        });
    }
};
