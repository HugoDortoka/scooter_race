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
            $table->char('sex', 1)->nullable();
            $table->integer('points')->default(0);
            $table->integer('discount')->default(0);
            $table->timestamps();
        });

        DB::statement("ALTER TABLE competitors ADD CONSTRAINT sex_constraint CHECK (sex IN ('m', 'f'))");

        DB::table('competitors')->insert([
            'DNI' => '28148365E',
            'name' => 'Juan',
            'surname' => 'Varela',
            'address' => '123 Rainbow Lane, Sparkle City',
            'date_of_birth' => '1990-04-12',
            'PRO' => true,
            'federation_number' => 'FED123456',
            'password' => bcrypt('28148365E'),
            'sex' => 'm',
            'points' => 1000,
            'discount' => 1,
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
            'sex' => 'm',
            'points' => 1000,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('competitors')->insert([
            'DNI' => '65040649F',
            'name' => 'Maria',
            'surname' => 'Luisa',
            'address' => '67 Main Street, Springfield',
            'date_of_birth' => '1980-04-12',
            'PRO' => true,
            'federation_number' => 'FED987654321',
            'password' => bcrypt('65040649F'),
            'sex' => 'f',
            'points' => 1000,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('competitors')->insert([
            'DNI' => '50808329H',
            'name' => 'Sergi',
            'surname' => 'Noob',
            'address' => '422 Oak Avenue, Riverside',
            'date_of_birth' => '2003-07-03',
            'PRO' => false,
            'password' => bcrypt('50808329H'),
            'sex' => 'm',
            'points' => 1000,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('competitors')->insert([
            'DNI' => '12198874L',
            'name' => 'Ana',
            'surname' => 'Bohueles',
            'address' => '789 Elm Street,Lakeview',
            'date_of_birth' => '1997-07-03',
            'PRO' => false,
            'password' => bcrypt('12198874L'),
            'sex' => 'f',
            'points' => 1000,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('competitors')->insert([
            'DNI' => '34207843N',
            'name' => 'Nora',
            'surname' => 'Salteada',
            'address' => '321 Maple Avenue, Hillcrest',
            'date_of_birth' => '1993-04-12',
            'PRO' => true,
            'federation_number' => 'FED246813579',
            'password' => bcrypt('34207843N'),
            'sex' => 'f',
            'points' => 2000,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('competitors')->insert([
            'DNI' => '63417053G',
            'name' => 'Pedro',
            'surname' => 'Picapiedra',
            'address' => '567 Pine Street, Cedarville',
            'date_of_birth' => '1981-07-03',
            'PRO' => false,
            'password' => bcrypt('63417053G'),
            'sex' => 'm',
            'points' => 3000,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('competitors')->insert([
            'DNI' => '62748041Q',
            'name' => 'Olga',
            'surname' => 'Undiez',
            'address' => '890 Cedar Avenue, Brookside',
            'date_of_birth' => '1986-04-12',
            'PRO' => true,
            'federation_number' => 'FED531246978',
            'password' => bcrypt('62748041Q'),
            'sex' => 'f',
            'points' => 10000,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('competitors')->insert([
            'DNI' => '59472579F',
            'name' => 'Montse',
            'surname' => 'Nocopiamos',
            'address' => '123 Willow Lane, Springfield',
            'date_of_birth' => '1988-07-03',
            'PRO' => false,
            'password' => bcrypt('59472579F'),
            'sex' => 'f',
            'points' => 9500,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('competitors')->insert([
            'DNI' => '65255109S',
            'name' => 'Pablo',
            'surname' => 'Estafador',
            'address' => '456 Birch Street, Oakdale',
            'date_of_birth' => '1978-07-03',
            'PRO' => false,
            'password' => bcrypt('65255109S'),
            'sex' => 'm',
            'points' => 4000,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('competitors')->insert([
            'DNI' => '09397812N',
            'name' => 'Ruben',
            'surname' => 'Paga',
            'address' => '789 Magnolia Avenue, Greenwood',
            'date_of_birth' => '1979-04-12',
            'PRO' => true,
            'federation_number' => 'FED765432109',
            'password' => bcrypt('09397812N'),
            'sex' => 'm',
            'points' => 6000,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('competitors')->insert([
            'DNI' => '39753342G',
            'name' => 'Piper',
            'surname' => 'Mirarriba',
            'address' => '890 Willow Street, Riverside',
            'date_of_birth' => '2002-07-03',
            'PRO' => false,
            'password' => bcrypt('39753342G'),
            'sex' => 'f',
            'points' => 8000,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('competitors')->insert([
            'DNI' => '35940033A',
            'name' => 'El',
            'surname' => 'Primo',
            'address' => '123 Cedar Avenue, Pineville',
            'date_of_birth' => '2000-04-12',
            'PRO' => false,
            'password' => bcrypt('35940033A'),
            'sex' => 'm',
            'points' => 2200,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('competitors')->insert([
            'DNI' => '07072181A',
            'name' => 'Edgar',
            'surname' => 'Main',
            'address' => '456 Oak Street, Springfield',
            'date_of_birth' => '1992-07-03',
            'PRO' => false,
            'password' => bcrypt('07072181A'),
            'sex' => 'm',
            'points' => 7000,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('competitors')->insert([
            'DNI' => '75100270A',
            'name' => 'Nita',
            'surname' => 'Ballenita',
            'address' => '789 Elm Avenue, Brookside',
            'date_of_birth' => '1981-07-03',
            'PRO' => false,
            'password' => bcrypt('75100270A'),
            'sex' => 'f',
            'points' => 5000,
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
