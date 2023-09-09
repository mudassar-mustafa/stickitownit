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
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->text('name')->nullable();
            $table->string('slug')->nullable();
            $table->text('title')->nullable();
            $table->longText('summary')->nullable();
            $table->longText('description')->nullable();
            $table->string('image')->default('default.png');
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->enum('is_featured', ['yes', 'no'])->default('no');
            $table->integer('is_order')->default(0);
            $table->text('author_name')->nullable();
            $table->text('meta_title')->nullable();
            $table->longText('meta_description')->nullable();
            $table->longText('meta_keywords')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};
