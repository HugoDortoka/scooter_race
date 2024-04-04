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
        Schema::create('competitors', function (Blueprint $table) {
            $table->id();
            $table->string('DNI')->unique();
            $table->string('name');
            $table->string('surname');
            $table->string('address');
            $table->date('date_of_birth');
            $table->boolean('PRO')->default(false);
            $table->string('federation_number')->nullable();
            $table->string('password')->nullable();
            $table->timestamps();
        });

        DB::table('competitors')->insert([
            'DNI' => '28148365E',
            'name' => 'Juan',
            'surname' => 'Varela',
            'address' => '123 Rainbow Lane, Sparkle City',
            'date_of_birth' => '1990-04-12',
            'PRO' => true,
            'federation_number' => 'FED123456',
            'password' => bcrypt('28148365E'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('competitors')->insert([
            'DNI' => '44587682C',
            'name' => 'Juan',
            'surname' => 'Moreno',
            'address' => '77 Elm Street, Springfield',
            'date_of_birth' => '1995-07-03',
            'PRO' => false,
            'password' => bcrypt('44587682C'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('competitors');
    }
};
