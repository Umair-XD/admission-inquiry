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

            // rename existing columns
            $table->renameColumn('id_card', 'cnic');
            $table->renameColumn('phone_no', 'mobile');

            // add new columns
            $table->string('address')->after('age');
            $table->string('password')->after('address');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('students', function (Blueprint $table) {

            $table->renameColumn('cnic', 'id_card');
            $table->renameColumn('mobile', 'phone_no');

            $table->dropColumn(['address', 'password']);
        });
    }
};
