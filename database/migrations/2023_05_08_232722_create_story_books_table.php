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
        Schema::create('story_books', function (Blueprint $table) {
            $table->id();
            $table->text('title');
            $table->text('playable_url');
            $table->enum('subscription_type', ['free', 'paid'])->default('free');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kids_books');
    }
};
