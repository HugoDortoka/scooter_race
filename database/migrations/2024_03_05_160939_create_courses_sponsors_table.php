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
        Schema::create('courses_sponsors', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('course_id');
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
            $table->unsignedBigInteger('sponsor_id');
            $table->foreign('sponsor_id')->references('id')->on('sponsors')->onDelete('cascade');
            $table->timestamps();
        });

        DB::table('courses_sponsors')->insert([
            'course_id' => 1,
            'sponsor_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('courses_sponsors')->insert([
            'course_id' => 1,
            'sponsor_id' => 3,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('courses_sponsors')->insert([
            'course_id' => 1,
            'sponsor_id' => 5,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('courses_sponsors')->insert([
            'course_id' => 2,
            'sponsor_id' => 2,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('courses_sponsors')->insert([
            'course_id' => 2,
            'sponsor_id' => 4,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('courses_sponsors')->insert([
            'course_id' => 3,
            'sponsor_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('courses_sponsors')->insert([
            'course_id' => 3,
            'sponsor_id' => 4,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('courses_sponsors')->insert([
            'course_id' => 4,
            'sponsor_id' => 2,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('courses_sponsors')->insert([
            'course_id' => 4,
            'sponsor_id' => 3,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('courses_sponsors')->insert([
            'course_id' => 4,
            'sponsor_id' => 5,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('courses_sponsors')->insert([
            'course_id' => 5,
            'sponsor_id' => 2,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('courses_sponsors')->insert([
            'course_id' => 6,
            'sponsor_id' => 4,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('courses_sponsors')->insert([
            'course_id' => 6,
            'sponsor_id' => 5,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('courses_sponsors')->insert([
            'course_id' => 7,
            'sponsor_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('courses_sponsors')->insert([
            'course_id' => 7,
            'sponsor_id' => 3,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('courses_sponsors')->insert([
            'course_id' => 8,
            'sponsor_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('courses_sponsors')->insert([
            'course_id' => 8,
            'sponsor_id' => 2,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('courses_sponsors')->insert([
            'course_id' => 8,
            'sponsor_id' => 3,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('courses_sponsors')->insert([
            'course_id' => 9,
            'sponsor_id' => 4,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('courses_sponsors')->insert([
            'course_id' => 9,
            'sponsor_id' => 5,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses_sponsors');
    }
};
