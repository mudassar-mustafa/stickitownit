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
        Schema::create('generation_images', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('generation_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
                $table->mediumText('image')->nullable();
            $table->foreign('generation_id')->references('id')->on('generations')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('generation_images');
    }
};
