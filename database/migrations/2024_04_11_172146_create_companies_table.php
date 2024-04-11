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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('CIF')->unique();
            $table->string('name');
            $table->string('address');
            $table->string('email');
            $table->timestamps();
        });

        DB::table('companies')->insert([
            'CIF' => 'J81372286',
            'name' => 'Scooter Leveling',
            'address' => '789 Willow Street, Oakdale Neighborhood',
            'email' => 'scooter.leveling@gmail.com',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
