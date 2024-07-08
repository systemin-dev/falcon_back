<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Boat;
use App\Models\BoatRange;
use App\Models\Dimension;
use App\Models\BoatTranslation;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

use App\Models\User;

class BoatRoutesTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    protected function setUp(): void
    {
        parent::setUp();

        // Créez le rôle si nécessaire
        $role = \App\Models\Role::firstOrCreate(['id' => 1], ['name' => 'Admin']);

        // Créez l'utilisateur avec ce rôle
        $this->user = \App\Models\User::firstOrCreate(
            ['email' => 'admin@example.com'], // Remplacez par l'email souhaité
            [
                'name' => 'Admin User',
                'password' => \Illuminate\Support\Facades\Hash::make('password'), // Mot de passe sécurisé
                'role_id' => $role->id,
            ]
        );
    }


    public function test_admin_boats_index()
    {
        $response = $this->actingAs($this->user)->get('/admin/boats');
        $response->assertStatus(200);
    }

    public function test_admin_boats_store()
    {
        Storage::fake('images');

        $response = $this->actingAs($this->user)->post('/admin/boats', [
            'category' => '1',
            'image' => UploadedFile::fake()->image('test_image.jpg'),
            'condition' => 'new',
        ]);

        $response->assertStatus(302);
        $this->assertDatabaseHas('boats', ['category' => '1']);
    }

    public function test_admin_boats_create()
    {
        $response = $this->actingAs($this->user)->get('/admin/boats/create');
        $response->assertStatus(200);
    }


    public function test_admin_boats_update()
    {
        $boat = Boat::factory()->create(['category' => '1']);
        $response = $this->actingAs($this->user)->put('/admin/boats/' . $boat->id, [
            'category' => '4',
        ]);
        $response->assertStatus(302);
        $this->assertDatabaseHas('boats', ['category' => '4']);
    }


    public function test_admin_boats_destroy()
    {
        $boat = Boat::factory()->create();
        $response = $this->actingAs($this->user)->delete('/admin/boats/' . $boat->id);
        $response->assertStatus(302);
        $this->assertDatabaseMissing('boats', ['id' => $boat->id]);
    }



    public function test_admin_boats_dimensions_store()
    {
        $boat = Boat::factory()->create();
        $response = $this->actingAs($this->user)->post('/admin/boats/' . $boat->id . '/dimensions', [
            'dimension' => 'Test Dimension',
        ]);
        $response->assertStatus(302);
        $this->assertDatabaseHas('dimensions', ['dimension' => 'Test Dimension']);
    }

    public function test_admin_boats_dimensions_create()
    {
        $boat = Boat::factory()->create();
        $response = $this->actingAs($this->user)->get('/admin/boats/' . $boat->id . '/dimensions/create');
        $response->assertStatus(200);
    }

    public function test_admin_boats_dimensions_update()
    {
        $boat = Boat::factory()->create();
        $dimension = Dimension::factory()->create(['boat_id' => $boat->id]);
        $response = $this->actingAs($this->user)->put('/admin/boats/' . $boat->id . '/dimensions/' . $dimension->id, [
            'dimension' => 'Updated Dimension',
        ]);
        $response->assertStatus(302);
        $this->assertDatabaseHas('dimensions', ['dimension' => 'Updated Dimension']);
    }

    public function test_admin_boats_dimensions_destroy()
    {
        $boat = Boat::factory()->create();
        $dimension = Dimension::factory()->create(['boat_id' => $boat->id]);
        $response = $this->actingAs($this->user)->delete('/admin/boats/' . $boat->id . '/dimensions/' . $dimension->id);
        $response->assertStatus(302);
        $this->assertDatabaseMissing('dimensions', ['id' => $dimension->id]);
    }

    public function test_admin_boats_dimensions_edit()
    {
        $boat = Boat::factory()->create();
        $dimension = Dimension::factory()->create(['boat_id' => $boat->id]);
        $response = $this->actingAs($this->user)->get('/admin/boats/' . $boat->id . '/dimensions/' . $dimension->id . '/edit');
        $response->assertStatus(200);
    }

    public function test_admin_boats_edit()
    {
        $boat = Boat::factory()->create();
        $response = $this->actingAs($this->user)->get('/admin/boats/' . $boat->id . '/edit');
        $response->assertStatus(200);
    }



    public function test_admin_boats_ranges_store()
    {
        $boat = Boat::factory()->create();
        $response = $this->actingAs($this->user)->post('/admin/boats/' . $boat->id . '/ranges', [
            'range' => 'Test Range',
        ]);
        $response->assertStatus(302);
        $this->assertDatabaseHas('boat_ranges', ['range' => 'Test Range']);
    }

    public function test_admin_boats_ranges_create()
    {
        $boat = Boat::factory()->create();
        $response = $this->actingAs($this->user)->get('/admin/boats/' . $boat->id . '/ranges/create');
        $response->assertStatus(200);
    }

    public function test_admin_boats_ranges_update()
    {
        $boat = Boat::factory()->create();
        $range = BoatRange::factory()->create(['boat_id' => $boat->id]);
        $response = $this->actingAs($this->user)->put('/admin/boats/' . $boat->id . '/ranges/' . $range->id, [
            'range' => 'Updated Range',
        ]);
        $response->assertStatus(302);
        $this->assertDatabaseHas('boat_ranges', ['range' => 'Updated Range']);
    }

    public function test_admin_boats_ranges_destroy()
    {
        $boat = Boat::factory()->create();
        $range = BoatRange::factory()->create(['boat_id' => $boat->id]);
        $response = $this->actingAs($this->user)->delete('/admin/boats/' . $boat->id . '/ranges/' . $range->id);
        $response->assertStatus(302);
        $this->assertDatabaseMissing('boat_ranges', ['id' => $range->id]);
    }

    public function test_admin_boats_ranges_edit()
    {
        $boat = Boat::factory()->create();
        $range = BoatRange::factory()->create(['boat_id' => $boat->id]);
        $response = $this->actingAs($this->user)->get('/admin/boats/' . $boat->id . '/ranges/' . $range->id . '/edit');
        $response->assertStatus(200);
    }

    public function test_admin_boats_translations_store()
    {
        $boat = Boat::factory()->create();
        $response = $this->actingAs($this->user)->post('/admin/boats/' . $boat->id . '/translations', [
            'translation' => 'Test Translation',
        ]);
        $response->assertStatus(302);
        $this->assertDatabaseHas('boat_translations', ['translation' => 'Test Translation']);
    }

    public function test_admin_boats_translations_create()
    {
        $boat = Boat::factory()->create();
        $response = $this->actingAs($this->user)->get('/admin/boats/' . $boat->id . '/translations/create');
        $response->assertStatus(200);
    }

    public function test_admin_boats_translations_update()
    {
        $boat = Boat::factory()->create();
        $translation = BoatTranslation::factory()->create(['boat_id' => $boat->id]);
        $response = $this->actingAs($this->user)->put('/admin/boats/' . $boat->id . '/translations/' . $translation->id, [
            'translation' => 'Updated Translation',
        ]);
        $response->assertStatus(302);
        $this->assertDatabaseHas('boat_translations', ['translation' => 'Updated Translation']);
    }

    public function test_admin_boats_translations_destroy()
    {
        $boat = Boat::factory()->create();
        $translation = BoatTranslation::factory()->create(['boat_id' => $boat->id]);
        $response = $this->actingAs($this->user)->delete('/admin/boats/' . $boat->id . '/translations/' . $translation->id);
        $response->assertStatus(302);
        $this->assertDatabaseMissing('boat_translations', ['id' => $translation->id]);
    }

    public function test_admin_boats_translations_edit()
    {
        $boat = Boat::factory()->create();
        $translation = BoatTranslation::factory()->create(['boat_id' => $boat->id]);
        $response = $this->actingAs($this->user)->get('/admin/boats/' . $boat->id . '/translations/' . $translation->id . '/edit');
        $response->assertStatus(200);
    }
}
