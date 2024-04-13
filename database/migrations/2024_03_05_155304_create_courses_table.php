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
            $table->boolean('pointed')->default(false);
            $table->timestamps();
        });

        DB::table('courses')->insert([
            'name' => 'Lightning Speed',
            'description' => 'Is an exciting electric scooter race that challenges participants to demonstrate their skill and speed on a course full of obstacles and curves',
            'elevation' => 10,
            'map_image' => 'img/map_images/1710867860_Lightning Speed.png',
            'max_participants' => 1,
            'distance_km' => 10.5,
            'date' => '2025-01-07',
            'time' => '09:00:00',
            'location' => '123 Electric Speed Street',
            'promotion_poster' => 'img/promotion_posters/1710867860_Lightning Speed.jpg',
            'sponsorship_cost' => 150.00,
            'registration_price' => 25.00,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('courses')->insert([
            'name' => 'Electric Scooter',
            'description' => 'Is an exciting event where electric mobility enthusiasts compete in an electric scooter race',
            'elevation' => 30,
            'map_image' => 'img/map_images/1710868556_Electric Scooter.png',
            'max_participants' => 30,
            'distance_km' => 15,
            'date' => '2024-09-03',
            'time' => '12:00:00',
            'location' => '98 Volt Street',
            'promotion_poster' => 'img/promotion_posters/1710868556_Electric Scooter.jpg',
            'sponsorship_cost' => 125.00,
            'registration_price' => 20.00,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('courses')->insert([
            'name' => 'Extreme Challenge',
            'description' => 'Is an exciting electric scooter race that challenges participants to compete on a course full of obstacles and varied terrain',
            'elevation' => 60,
            'map_image' => 'img/map_images/1710868952_Extreme Challenge.png',
            'max_participants' => 10,
            'distance_km' => 5,
            'date' => '2024-07-15',
            'time' => '16:00:00',
            'location' => '33 Extreme Velocity Street',
            'promotion_poster' => 'img/promotion_posters/1710868952_Extreme Challenge.jpg',
            'sponsorship_cost' => 140.00,
            'registration_price' => 30.00,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('courses')->insert([
            'name' => 'Voltage Velocity',
            'description' => 'Is an exciting competition that tests the skill and speed of the participants in the exciting world of electric scooters',
            'elevation' => 0,
            'map_image' => 'img/map_images/1710869269_Voltage Velocity.png',
            'max_participants' => 60,
            'distance_km' => 20.8,
            'date' => '2024-03-15',
            'time' => '20:00:00',
            'location' => '13 Voltage Velocity Street',
            'promotion_poster' => 'img/promotion_posters/1710869269_Voltage Velocity.jpg',
            'sponsorship_cost' => 200.00,
            'registration_price' => 8.50,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('courses')->insert([
            'name' => 'Turbo Scoot',
            'description' => 'Challenge your speed and skill as you compete against your friends on a fast-paced course full of exciting turns and obstacles',
            'elevation' => 5,
            'map_image' => 'img/map_images/1710869625_Turbo Scoot.png',
            'max_participants' => 8,
            'distance_km' => 12,
            'date' => '2024-04-30',
            'time' => '13:00:00',
            'location' => 'Electric Avenue, 24A',
            'promotion_poster' => 'img/promotion_posters/1710869625_Turbo Scoot.jpg',
            'sponsorship_cost' => 20.00,
            'registration_price' => 18.00,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('courses')->insert([
            'name' => 'Electrifying Circuit',
            'description' => 'With dizzying speeds and pure adrenaline, this experience offers racers the opportunity to demonstrate their skill and ability in an electric and exciting environment',
            'elevation' => 45,
            'map_image' => 'img/map_images/1710869944_Electrifying Circuit.png',
            'max_participants' => 66,
            'distance_km' => 4,
            'date' => '2024-05-22',
            'time' => '17:00:00',
            'location' => 'Spark Avenue, 456',
            'promotion_poster' => 'img/promotion_posters/1710869944_Electrifying Circuit.jpg',
            'sponsorship_cost' => 40.00,
            'registration_price' => 11.00,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('courses')->insert([
            'name' => 'Electric Grand Prix',
            'description' => 'Is an exciting electric scooter race that combines speed, skill and agility in an exciting competitive event',
            'elevation' => 23,
            'map_image' => 'img/map_images/1710870352_Electric Grand Prix.png',
            'max_participants' => 77,
            'distance_km' => 24,
            'date' => '2024-06-17',
            'time' => '10:00:00',
            'location' => 'Electric Boulevard, 789',
            'promotion_poster' => 'img/promotion_posters/1710870352_Electric Grand Prix.jpg',
            'sponsorship_cost' => 80.00,
            'registration_price' => 12.00,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('courses')->insert([
            'name' => 'Voltage Marathon',
            'description' => 'Is an exciting electric scooter race that challenges participants to travel an urban circuit full of adrenaline and excitement',
            'elevation' => 8,
            'map_image' => 'img/map_images/1710870706_Voltage Marathon.png',
            'max_participants' => 35,
            'distance_km' => 14,
            'date' => '2024-05-05',
            'time' => '15:00:00',
            'location' => '45 Electrodynamics Street',
            'promotion_poster' => 'img/promotion_posters/1710870706_Voltage Marathon.jpg',
            'sponsorship_cost' => 110.00,
            'registration_price' => 22.00,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('courses')->insert([
            'name' => 'Spark Circuit',
            'description' => 'Competitors face off in an intense competition where maneuvering skills and speed are key to victory',
            'elevation' => 21,
            'map_image' => 'img/map_images/1710871066_Spark Circuit.png',
            'max_participants' => 44,
            'distance_km' => 9,
            'date' => '2024-06-13',
            'time' => '23:00:00',
            'location' => 'Lightning Lane Avenue, 456',
            'promotion_poster' => 'img/promotion_posters/1710871066_Spark Circuit.jpg',
            'sponsorship_cost' => 10.00,
            'registration_price' => 2.00,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
