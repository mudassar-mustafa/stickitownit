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
        Schema::create('product_attribute_value_groups', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id')->nullable();
            $table->unsignedBigInteger('product_group_id')->nullable();
            $table->unsignedBigInteger('product_attribute_val_id')->nullable();
            $table->softDeletes();
            $table->timestamps();

            
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('product_attribute_val_id')->references('id')->on('attribute_values')->onDelete('cascade');
            $table->foreign('product_group_id')->references('id')->on('product_attribute_groups')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_attribute_value_groups');
    }
};
