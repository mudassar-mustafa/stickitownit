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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->text('logo_header')->nullable();
            $table->text('logo_footer')->nullable();
            $table->text('company_name')->nullable();
            $table->text('company_short_description')->nullable();
            $table->text('email')->nullable();
            $table->text('phone_number')->nullable();
            $table->text('address')->nullable();
            $table->text('office_hours')->nullable();
            $table->text('office_working_days')->nullable();
            $table->text('banner_one')->nullable();
            $table->text('banner_two')->nullable();
            $table->text('banner_tag_line')->nullable();
            $table->text('banner_tag_line_description')->nullable();
            $table->text('facebook_url')->nullable();
            $table->text('twitter_url')->nullable();
            $table->text('instagram_url')->nullable();
            $table->text('youtube_url')->nullable();
            $table->text('linkedin_url')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
