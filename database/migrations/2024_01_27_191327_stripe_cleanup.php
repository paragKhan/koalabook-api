<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $columns = ['stripe_id', 'pm_type', 'pm_last_four', 'trial_ends_at'];
        if (Schema::hasColumns('users', $columns)) {
            Schema::dropColumns('users', $columns);
        }

        Schema::dropIfExists('subscriptions');
        Schema::dropIfExists('subscription_items');
        Schema::dropIfExists('subscription_plans');
        Schema::dropIfExists('webhook_calls');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('subscription_expires_at');
        });
    }
};
