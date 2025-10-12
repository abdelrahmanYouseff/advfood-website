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
        Schema::table('customer_orders', function (Blueprint $table) {
            $table->string('order_number')->nullable()->after('id');
            $table->string('payment_status')->default('pending')->after('status'); // pending, paid, failed
            $table->string('noon_order_id')->nullable()->after('payment_status');
            $table->text('payment_data')->nullable()->after('noon_order_id');
            $table->string('customer_email')->nullable()->after('customer_phone');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('customer_orders', function (Blueprint $table) {
            $table->dropColumn(['order_number', 'payment_status', 'noon_order_id', 'payment_data', 'customer_email']);
        });
    }
};
