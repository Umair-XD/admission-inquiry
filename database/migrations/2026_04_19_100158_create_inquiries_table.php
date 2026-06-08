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
        Schema::create('inquiries', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('age');
            $table->string('department');
            $table->string('phone');
            $table->string('cnic');

            $table->integer('matric_obtained')->nullable();
            $table->integer('matric_total')->nullable();

            $table->integer('part1_obtained')->nullable();
            $table->integer('part1_total')->nullable();

            $table->integer('part2_obtained')->nullable();
            $table->integer('part2_total')->nullable();

            $table->integer('entry_obtained')->nullable();
            $table->integer('entry_total')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inquiries');
    }
};
