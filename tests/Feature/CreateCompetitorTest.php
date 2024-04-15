<?php

namespace Tests\Feature;

use App\Models\Competitor;
use Database\Factories\CompetitorFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateCompetitorTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_create_competitor(): void{
        if ($this->assertDatabaseMissing('competitors', ['DNI' => '25773121B'] )) {
            Competitor::factory()->create([
                'DNI' => '25773121B',
                'name' => 'Silvia',
                'surname' => 'Garcia',
                'address' => '67 Main Street, Springfield',
                'date_of_birth' => '1980-04-12',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
  
            $this->assertDatabaseHas('competitors', [
                'DNI' => '25773121B',
                'name' => 'Silvia',
                'surname' => 'Garcia',
                'address' => '67 Main Street, Springfield',
                'date_of_birth' => '1980-04-12',
            ]);
        }
    }
}
