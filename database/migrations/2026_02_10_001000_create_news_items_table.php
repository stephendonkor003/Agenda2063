<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('news_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('department_id')->nullable()->index();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('type')->default('article'); // article, event, press
            $table->string('status')->default('draft'); // draft, published, scheduled
            $table->string('category')->nullable();
            $table->text('summary')->nullable();
            $table->longText('body')->nullable();
            $table->string('banner_path')->nullable();
            $table->boolean('featured')->default(false);
            $table->unsignedBigInteger('views')->default(0);
            $table->timestamp('published_at')->nullable();
            $table->timestamp('starts_at')->nullable(); // for events
            $table->timestamp('ends_at')->nullable();
            $table->string('location')->nullable(); // for events
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('news_items');
    }
};
