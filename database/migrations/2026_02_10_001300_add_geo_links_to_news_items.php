<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('news_items', function (Blueprint $table) {
            $table->string('country_code', 3)->nullable()->index()->after('category_id');
            $table->string('region_code', 10)->nullable()->index()->after('country_code'); // e.g., ECOWAS, SADC
        });
    }

    public function down(): void
    {
        Schema::table('news_items', function (Blueprint $table) {
            $table->dropColumn(['country_code', 'region_code']);
        });
    }
};
