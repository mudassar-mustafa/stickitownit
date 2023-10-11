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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('order_number')->nullable();
            $table->integer('invoice_number')->nullable();
            $table->string('order_type')->nullable();
            $table->string('order_status')->nullable();
            $table->dateTime('order_date')->nullable();
            $table->dateTime('order_paid_date')->nullable();
            $table->dateTime('order_shipped_date')->nullable();
            $table->dateTime('order_cancelled_date')->nullable();
            $table->dateTime('order_delivered_date')->nullable();
            $table->unsignedBigInteger('buyer_id')->nullable();
            $table->unsignedBigInteger('seller_id')->nullable();
            $table->string('payment_method')->nullable();
            $table->string('transaction_id')->nullable();
            $table->string('transaction_slip_url')->nullable();
            $table->decimal('order_total_amount', 8,2)->nullable();
            $table->string('notes')->nullable();
            $table->string('cancel_reason')->nullable();
            $table->boolean('is_view')->nullable()->default(false);
            $table->string('billing_name')->nullable();
            $table->string('billing_email')->nullable();
            $table->string('billing_phone')->nullable();
            $table->string('billing_zip_code')->nullable();
            $table->string('billing_country_id')->nullable();
            $table->string('billing_state_id')->nullable();
            $table->string('billing_city_id')->nullable();
            $table->string('billing_address')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('buyer_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('seller_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
