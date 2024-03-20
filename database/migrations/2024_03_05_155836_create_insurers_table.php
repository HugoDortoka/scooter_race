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
        Schema::create('insurers', function (Blueprint $table) {
            $table->id();
            $table->string('CIF')->unique();
            $table->string('name');
            $table->string('address');
            $table->decimal('price_per_course', 8, 2);
            $table->boolean('active')->default(true);
            $table->timestamps();
        });

        DB::table('insurers')->insert([
            'CIF' => 'J40407488',
            'name' => 'Adeslas',
            'address' => '34 Security Avenue',
            'price_per_course' => 23.00,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('insurers')->insert([
            'CIF' => 'W3974150I',
            'name' => 'Allianz',
            'address' => '234 Tranquility Street',
            'price_per_course' => 40.00,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('insurers')->insert([
            'CIF' => 'U74739905',
            'name' => 'Mutua',
            'address' => '41 Precaution Drive',
            'price_per_course' => 65.00,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('insurers')->insert([
            'CIF' => 'H03599511',
            'name' => 'MAPFRE',
            'address' => '101 Secure Boulevard',
            'price_per_course' => 18.00,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('insurers')->insert([
            'CIF' => 'N0669939A',
            'name' => 'Sanitas',
            'address' => '67 Secure Avenue',
            'price_per_course' => 50.00,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('insurers');
    }
};
