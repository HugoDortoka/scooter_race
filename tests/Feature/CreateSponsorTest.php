<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Sponsor;
use Database\Factories\SponsorFactory;

class CreateSponsorTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_create_sponsor(): void
    {
        if($this->assertDatabaseMissing('sponsors', ['CIF' => 'V24808776'])){
            Sponsor::factory()->create([
                'CIF' => 'V24808776',
                'name' => 'Nike',
                'address' => '17 Willow Street, Springfield',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $this->assertDatabaseHas('sponsors', [
                'CIF' => 'V24808776',
                'name' => 'Nike',
                'address' => '17 Willow Street, Springfield',
            ]);
        }
    }
}
