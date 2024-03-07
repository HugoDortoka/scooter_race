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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->integer('elevation');
            $table->string('map_image')->nullable();
            $table->integer('max_participants');
            $table->float('distance_km');
            $table->date('date');
            $table->time('time');
            $table->string('location');
            $table->string('promotion_poster')->nullable();
            $table->decimal('sponsorship_cost', 8, 2);
            $table->decimal('registration_price', 8, 2);
            $table->boolean('active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
