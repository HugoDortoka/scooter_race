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
        Schema::create('photos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('course_id');
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
            $table->string('photo_url');
            $table->timestamps();
        });

        DB::table('photos')->insert([
            'course_id' => 4,
            'photo_url' => 'img/photos_courses/1711714675_banner-bg.png',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('photos')->insert([
            'course_id' => 4,
            'photo_url' => 'img/photos_courses/1711714675_circuito1.jpg',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('photos')->insert([
            'course_id' => 4,
            'photo_url' => 'img/photos_courses/1711714676_NIkepromotion.jpg',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('photos')->insert([
            'course_id' => 4,
            'photo_url' => 'img/photos_courses/1711789275_img.jpg',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('photos')->insert([
            'course_id' => 4,
            'photo_url' => 'img/photos_courses/1711789275_Tulips_10_IMG.jpg',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('photos')->insert([
            'course_id' => 4,
            'photo_url' => 'img/photos_courses/1711789343_website.jpg',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('photos');
    }
};
