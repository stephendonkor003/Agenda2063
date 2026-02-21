<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('analytics_events', function (Blueprint $table) {
            $table->id();
            $table->foreignId('session_id')->nullable()->index();
            $table->string('type')->default('pageview'); // pageview, download, quiz, subscription, other
            $table->string('path')->nullable();
            $table->string('country', 3)->nullable()->index();
            $table->string('region')->nullable();
            $table->string('ip', 45)->nullable();
            $table->string('user_agent')->nullable();
            $table->integer('duration_seconds')->nullable(); // time since last hit
            $table->json('meta')->nullable(); // flexible payload (e.g., quiz_id, file_url)
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('analytics_events');
    }
};
