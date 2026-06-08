<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('inquiry_degrees', function (Blueprint $table) {
            $table->id();

            // 🔗 THIS links to student/inquiry
            $table->foreignId('inquiry_id')->constrained()->onDelete('cascade');

            // 🔗 THIS links to degree type
            $table->foreignId('degree_id')->constrained()->onDelete('cascade');

            // marks
            $table->integer('obtained')->nullable();
            $table->integer('total')->nullable();

            $table->integer('part1_obtained')->nullable();
            $table->integer('part1_total')->nullable();
            $table->integer('part2_obtained')->nullable();
            $table->integer('part2_total')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inquiry_degrees');
    }
};
