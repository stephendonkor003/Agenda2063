<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('regional_reports', function (Blueprint $table) {
            $table->id();
            $table->string('region_code', 10)->unique();
            $table->string('region_name');
            $table->year('year')->default(2026);
            $table->string('status')->default('draft'); // draft, submitted, published
            $table->decimal('overall_score', 5, 2)->default(0);
            $table->string('banner_path')->nullable();
            $table->text('summary')->nullable();
            $table->longText('body')->nullable();
            $table->unsignedBigInteger('downloads')->default(0);
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('regional_reports');
    }
};
