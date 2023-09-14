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
        Schema::create('product_attribute_groups', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id')->nullable();
            $table->string('main_image');
            $table->string('short_description');
            $table->string('sku');
            $table->integer('quantity')->default('0');
            $table->decimal('price', 8,2)->default('0');
            $table->boolean('visibilty')->nullable()->default(false);
            $table->softDeletes();
            $table->timestamps();

            
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_attribute_groups');
    }
};
