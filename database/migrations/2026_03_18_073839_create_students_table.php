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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('department');
            $table->integer('age');
            $table->string('phone_no', 20);
            $table->string('id_card', 20)->unique();
            $table->integer('matric_marks');
            $table->integer('part1_marks');
            $table->integer('part2_marks');
            $table->integer('entry_test_marks');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
