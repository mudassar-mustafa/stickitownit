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
        Schema::create('blog_category_pivots', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('blog_id')->index();
            $table->unsignedBigInteger('category_id')->index();
            $table->foreign('blog_id')->references('id')->on('blogs')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('blog_categories')->onDelete('cascade');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blog_category_pivots');
    }
};
