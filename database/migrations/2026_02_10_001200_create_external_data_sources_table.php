<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('external_data_sources', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('provider')->nullable(); // e.g., UNDP, AfDB, Custom
            $table->string('type')->default('rest'); // rest, graphql, sftp, manual
            $table->string('base_url')->nullable();
            $table->string('auth_type')->default('api_key'); // api_key, bearer, basic, none
            $table->string('api_key')->nullable();
            $table->string('auth_header')->nullable(); // e.g., X-API-Key
            $table->string('status')->default('inactive'); // active, inactive, error
            $table->timestamp('last_synced_at')->nullable();
            $table->string('sync_frequency')->default('daily'); // hourly,daily,weekly,manual
            $table->json('mapping')->nullable(); // JSON mapping of indicators/goal ids
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('external_data_sources');
    }
};
