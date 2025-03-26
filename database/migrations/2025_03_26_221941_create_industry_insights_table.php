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
        Schema::create('industry_insights', function (Blueprint $table) {
            $table->id();
            $table->string('thumbnail_image')->nullable();
            $table->string('pdf_title');
            $table->string('pdf_link'); // Stores PDF file path
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('industry_insights');
    }
};
