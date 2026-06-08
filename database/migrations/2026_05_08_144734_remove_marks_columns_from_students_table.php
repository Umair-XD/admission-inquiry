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
        Schema::table('students', function (Blueprint $table) {

            $table->dropColumn([
                'matric_marks',
                'part1_marks',
                'part2_marks',
                'entry_test_marks'
            ]);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('students', function (Blueprint $table) {

            $table->integer('matric_marks');
            $table->integer('part1_marks');
            $table->integer('part2_marks');
            $table->integer('entry_test_marks');

        });
    }
};
