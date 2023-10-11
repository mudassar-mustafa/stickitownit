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
        Schema::create('quotes', function (Blueprint $table) {
            $table->id();
            $table->text('name')->nullable();
            $table->text('email')->nullable();
            $table->text('phone')->nullable();
            $table->text('country')->nullable();
            $table->text('company')->nullable();
            $table->text('website')->nullable();
            $table->text('project')->nullable();
            $table->text('material_type')->nullable();
            $table->text('width')->nullable();
            $table->text('height')->nullable();
            $table->text('quantity')->nullable();
            $table->text('file')->nullable();
            $table->longText('message')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quotes');
    }
};
