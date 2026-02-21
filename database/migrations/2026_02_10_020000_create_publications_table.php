<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('publications', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('type')->index(); // e.g., report, policy-brief, research-paper, communique
            $table->string('language', 50)->nullable()->index();
            $table->unsignedSmallInteger('year')->nullable()->index();
            $table->string('file_url')->nullable();
            $table->text('summary')->nullable();
            $table->unsignedBigInteger('downloads')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('publications');
    }
};
