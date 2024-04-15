<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Insurer;
use Database\Factories\InsurerFactory;

class CreateInsurerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_create_insurer(): void
    {
        if($this->assertDatabaseMissing('insurers', ['CIF' => 'C19245414'])){
            Insurer::factory()->create([
                'CIF' => 'C19245414',
                'name' => 'AXA',
                'address' => '44 Maple Street, Springfield',
                'price_per_course' => 11.00,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $this->assertDatabaseHas('insurers', [
                'CIF' => 'C19245414',
                'name' => 'AXA',
                'address' => '44 Maple Street, Springfield',
                'price_per_course' => 11.00,
            ]);
        }
    }
}
