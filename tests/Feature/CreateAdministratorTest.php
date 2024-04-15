<?php

namespace Tests\Feature;

use App\Models\Administrator;
use Database\Factories\AdministratorFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateAdministratorTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_create_administrators(): void{
        if ($this->assertDatabaseMissing('administrators', ['email' => 'adminNuevo@gmail.com',] )) {
            Administrator::factory()->create([
                'name' => 'admin',
                'email' => 'adminNuevo@gmail.com',
                'password' => bcrypt('admin'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
  
            $this->assertDatabaseHas('administrators', [
                'name' => 'admin',
                'email' => 'adminNuevo@gmail.com',

            ]);
        }
    }
}
