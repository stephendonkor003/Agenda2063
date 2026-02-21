<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('analytics_sessions', function (Blueprint $table) {
            $table->id();
            $table->uuid('sid')->unique();
            $table->string('ip', 45)->nullable();
            $table->string('user_agent')->nullable();
            $table->string('country', 3)->nullable()->index();
            $table->string('region')->nullable();
            $table->string('first_path')->nullable();
            $table->string('last_path')->nullable();
            $table->unsignedInteger('hits')->default(0);
            $table->unsignedInteger('total_seconds')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('analytics_sessions');
    }
};
