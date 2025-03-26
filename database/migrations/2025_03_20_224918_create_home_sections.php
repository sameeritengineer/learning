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
        Schema::create('talent_pools', function (Blueprint $table) {
            $table->id();
            $table->integer('numeric_talent');
            $table->decimal('pool_value', 10, 2);
            $table->timestamps();
        });

        Schema::create('retention_details', function (Blueprint $table) {
            $table->id();
            $table->decimal('percentage_rate', 5, 2);
            $table->string('time_period');
            $table->timestamps();
        });

        Schema::create('past_works', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('company_logo');
            $table->string('user_logo');
            $table->timestamps();
        });

        Schema::create('operated_domains', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->json('logos')->nullable(); // Store multiple logos as JSON
            $table->timestamps();
        });

        Schema::create('testimonials', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('position');
            $table->text('testimonial_description');
            $table->string('company_logo');
            $table->string('user_logo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('talent_pools');
        Schema::dropIfExists('retention_details');
        Schema::dropIfExists('past_works');
        Schema::dropIfExists('operated_domains');
        Schema::dropIfExists('testimonials');
    }
};
