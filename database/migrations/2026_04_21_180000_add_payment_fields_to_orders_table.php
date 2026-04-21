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
        Schema::table('orders', function (Blueprint $table) {
            $table->string('payment_status')->default('pending')->after('status'); // pending, completed, failed
            $table->string('payment_method')->nullable()->after('payment_status'); // stripe, etc
            $table->string('stripe_payment_intent_id')->nullable()->unique()->after('payment_method');
            $table->string('stripe_charge_id')->nullable()->unique()->after('stripe_payment_intent_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['payment_status', 'payment_method', 'stripe_payment_intent_id', 'stripe_charge_id']);
        });
    }
};
