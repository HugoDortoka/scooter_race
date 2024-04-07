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
        Schema::create('courses_insurers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('course_id');
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
            $table->unsignedBigInteger('insurer_id');
            $table->foreign('insurer_id')->references('id')->on('insurers')->onDelete('cascade');
            $table->timestamps();
        });

        DB::table('courses_insurers')->insert([
            'course_id' => 1,
            'insurer_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('courses_insurers')->insert([
            'course_id' => 1,
            'insurer_id' => 3,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('courses_insurers')->insert([
            'course_id' => 1,
            'insurer_id' => 5,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('courses_insurers')->insert([
            'course_id' => 2,
            'insurer_id' => 2,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('courses_insurers')->insert([
            'course_id' => 2,
            'insurer_id' => 4,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('courses_insurers')->insert([
            'course_id' => 3,
            'insurer_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('courses_insurers')->insert([
            'course_id' => 3,
            'insurer_id' => 4,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('courses_insurers')->insert([
            'course_id' => 4,
            'insurer_id' => 2,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('courses_insurers')->insert([
            'course_id' => 4,
            'insurer_id' => 3,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('courses_insurers')->insert([
            'course_id' => 4,
            'insurer_id' => 5,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('courses_insurers')->insert([
            'course_id' => 5,
            'insurer_id' => 2,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('courses_insurers')->insert([
            'course_id' => 6,
            'insurer_id' => 4,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('courses_insurers')->insert([
            'course_id' => 6,
            'insurer_id' => 5,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('courses_insurers')->insert([
            'course_id' => 7,
            'insurer_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('courses_insurers')->insert([
            'course_id' => 7,
            'insurer_id' => 3,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('courses_insurers')->insert([
            'course_id' => 8,
            'insurer_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('courses_insurers')->insert([
            'course_id' => 8,
            'insurer_id' => 2,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('courses_insurers')->insert([
            'course_id' => 8,
            'insurer_id' => 3,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('courses_insurers')->insert([
            'course_id' => 9,
            'insurer_id' => 4,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('courses_insurers')->insert([
            'course_id' => 9,
            'insurer_id' => 5,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses_insurers');
    }
};
