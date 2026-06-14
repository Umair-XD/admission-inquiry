<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('inquiries', function (Blueprint $table) {
            $table->string('department')->nullable()->change();
            $table->decimal('matric_obtained', 8, 2)->nullable()->change();
            $table->decimal('matric_total', 8, 2)->nullable()->change();
            $table->decimal('part1_obtained', 8, 2)->nullable()->change();
            $table->decimal('part1_total', 8, 2)->nullable()->change();
            $table->decimal('part2_obtained', 8, 2)->nullable()->change();
            $table->decimal('part2_total', 8, 2)->nullable()->change();
            $table->decimal('entry_obtained', 8, 2)->nullable()->change();
            $table->decimal('entry_total', 8, 2)->nullable()->change();
        });

        Schema::table('inquiry_degrees', function (Blueprint $table) {
            $table->decimal('obtained', 8, 2)->nullable()->change();
            $table->decimal('total', 8, 2)->nullable()->change();
            $table->decimal('part1_obtained', 8, 2)->nullable()->change();
            $table->decimal('part1_total', 8, 2)->nullable()->change();
            $table->decimal('part2_obtained', 8, 2)->nullable()->change();
            $table->decimal('part2_total', 8, 2)->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('inquiries', function (Blueprint $table) {
            $table->string('department')->nullable(false)->change();
            $table->integer('matric_obtained')->nullable()->change();
            $table->integer('matric_total')->nullable()->change();
            $table->integer('part1_obtained')->nullable()->change();
            $table->integer('part1_total')->nullable()->change();
            $table->integer('part2_obtained')->nullable()->change();
            $table->integer('part2_total')->nullable()->change();
            $table->integer('entry_obtained')->nullable()->change();
            $table->integer('entry_total')->nullable()->change();
        });

        Schema::table('inquiry_degrees', function (Blueprint $table) {
            $table->integer('obtained')->nullable()->change();
            $table->integer('total')->nullable()->change();
            $table->integer('part1_obtained')->nullable()->change();
            $table->integer('part1_total')->nullable()->change();
            $table->integer('part2_obtained')->nullable()->change();
            $table->integer('part2_total')->nullable()->change();
        });
    }
};
