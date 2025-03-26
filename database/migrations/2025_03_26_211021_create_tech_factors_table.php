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
         Schema::create('tech_factors', function (Blueprint $table) {
            $table->id();
            $table->string('season');
            $table->string('episode_title');
            $table->integer('episode_number');
            $table->string('thumbnail_image')->nullable();
            $table->string('video_link');
            $table->string('spotify_link')->nullable();
            $table->string('radio_link')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tech_factors');
    }
};
