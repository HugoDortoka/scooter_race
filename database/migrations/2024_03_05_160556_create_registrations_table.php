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
        Schema::create('registrations', function (Blueprint $table) {
            $table->id();
            $table->string('dorsal_number');
            $table->unsignedBigInteger('competitor_id');
            $table->foreign('competitor_id')->references('id')->on('competitors')->onDelete('cascade');
            $table->unsignedBigInteger('course_id');
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
            $table->unsignedBigInteger('insurer_id')->nullable();
            $table->foreign('insurer_id')->references('id')->on('insurers')->onDelete('set null');
            $table->time('Finish_Time')->nullable();
            $table->timestamps();
            // Crear un índice único compuesto en dorsal_number y course_id
            $table->unique(['dorsal_number', 'course_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registrations');
    }
};
