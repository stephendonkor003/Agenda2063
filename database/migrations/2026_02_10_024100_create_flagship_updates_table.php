<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('flagship_updates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('flagship_project_id')->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->string('type')->default('update'); // update, news, article
            $table->string('status')->default('pending'); // pending, approved, rejected
            $table->text('body')->nullable(); // HTML
            $table->timestamp('published_at')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('approved_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('rejected_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('flagship_updates');
    }
};
