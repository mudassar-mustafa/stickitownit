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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug');
            $table->string('product_type');
            $table->string('short_description')->nullable();
            $table->longText('description')->nullable();
            $table->string('main_image');
            $table->integer('quantity')->default('0');
            $table->decimal('price', 8,2)->default('0');
            $table->unsignedBigInteger('brand_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('shipping_type')->default('free');
            $table->decimal('shipping_fee', 8,2)->default('0');
            $table->string('status')->default('active');
            $table->softDeletes();
            $table->timestamps();

            
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
