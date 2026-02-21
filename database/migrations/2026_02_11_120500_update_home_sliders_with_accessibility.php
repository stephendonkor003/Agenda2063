<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('home_sliders', function (Blueprint $table) {
            $table->string('alt_text')->nullable()->after('image_url');
            $table->timestamp('starts_at')->nullable()->after('is_active');
            $table->timestamp('ends_at')->nullable()->after('starts_at');
        });
    }

    public function down(): void
    {
        Schema::table('home_sliders', function (Blueprint $table) {
            $table->dropColumn(['alt_text','starts_at','ends_at']);
        });
    }
};
