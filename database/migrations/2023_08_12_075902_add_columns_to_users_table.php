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
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('name');
            $table->string('fname')->after('id');
            $table->string('lname')->after('fname');
            $table->string('address')->after('password');
            $table->string('zip')->after('address');
            $table->string('country')->after('country');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('name')->after('id');
            $table->dropColumn('fname');
            $table->dropColumn('lname');
            $table->dropColumn('address');
            $table->dropColumn('zip');
            $table->dropColumn('country');
        });
    }
};
