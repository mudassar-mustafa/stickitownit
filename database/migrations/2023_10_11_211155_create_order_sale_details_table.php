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
        Schema::create('order_sale_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id')->nullable();
            $table->unsignedBigInteger('product_attribute_group_id')->nullable();
            $table->integer('qty')->nullable();
            $table->decimal('price', 10,2)->nullable();
            $table->decimal('shipping', 10,2)->nullable();
            $table->string('order_status')->nullable();
            $table->string('product_title')->nullable();
            $table->string('product_short_description')->nullable();
            $table->string('product_type')->nullable();
            $table->string('product_image')->nullable();
            $table->string('shipping_name')->nullable();
            $table->string('shipping_email')->nullable();
            $table->string('shipping_phone')->nullable();
            $table->string('shipping_zip_code')->nullable();
            $table->string('shipping_country_id')->nullable();
            $table->string('shipping_state_id')->nullable();
            $table->string('shipping_city_id')->nullable();
            $table->string('shipping_address')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
            $table->foreign('product_attribute_group_id')->references('id')->on('product_attribute_value_groups')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_sale_details');
    }
};
