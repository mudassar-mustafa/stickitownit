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
        Schema::table('settings', function (Blueprint $table) {
            $table->integer('number_of_images')->after('linkedin_url')->default(3);
            $table->text('model_id')->nullable();
            $table->text('width')->nullable();
            $table->text('height')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn('number_of_images');
            $table->dropColumn('model_id');
            $table->dropColumn('width');
            $table->dropColumn('height');
        });
    }
};
