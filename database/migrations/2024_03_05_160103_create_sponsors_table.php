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
        Schema::create('sponsors', function (Blueprint $table) {
            $table->id();
            $table->string('CIF')->unique();
            $table->string('name');
            $table->string('logo')->nullable();
            $table->string('address');
            $table->boolean('principal')->default(false);
            $table->decimal('extra_cost', 8, 2)->nullable();
            $table->boolean('active')->default(true);
            $table->timestamps();
        });

        DB::table('sponsors')->insert([
            'CIF' => 'E18886895',
            'name' => 'Adidas',
            'logo' => 'img/sponsors/1710951867_Adidas.png',
            'address' => '45 Main Street, Central City',
            'principal' => true,
            'extra_cost' => 50.00,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('sponsors')->insert([
            'CIF' => 'C34293746',
            'name' => 'Coca Cola',
            'logo' => 'img/sponsors/1710951904_Coca Cola.png',
            'address' => '12 Innovation Avenue, Tech District',
            'principal' => true,
            'extra_cost' => 50.00,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('sponsors')->insert([
            'CIF' => 'D02144350',
            'name' => 'VISA',
            'logo' => 'img/sponsors/1710951946_VISA.png',
            'address' => '3 Sun Street, Art Quarter',
            'extra_cost' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('sponsors')->insert([
            'CIF' => 'E12554036',
            'name' => 'MasterCard',
            'logo' => 'img/sponsors/1710951994_MasterCard.png',
            'address' => '67 Seafront Drive, Bright Coast',
            'extra_cost' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('sponsors')->insert([
            'CIF' => 'U26485805',
            'name' => 'McDonalds',
            'logo' => 'img/sponsors/1710952026_McDonalds.png',
            'address' => '5 Mayor Square, Historic Village',
            'extra_cost' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sponsors');
    }
};
