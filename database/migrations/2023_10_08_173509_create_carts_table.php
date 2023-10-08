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
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_attribute_group_id')->index();
            $table->unsignedBigInteger('user_id')->index()->nullable();
            $table->integer('qty')->nullable();
            $table->string('image_path')->nullable();
            $table->string('remarks')->nullable();
            $table->decimal('shipping_amount', 8,2)->nullable();
            $table->string('product_type')->nullable();
            $table->text('user_session_id')->nullable();
            $table->softDeletes();
            $table->timestamps();

            
            $table->foreign('product_attribute_group_id')->references('id')->on('product_attribute_groups')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};
