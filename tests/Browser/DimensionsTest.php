<?php

namespace Tests\Browser;

use App\Models\Boat;
use App\Models\User;
use App\Models\Dimension;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class DimensionsTest extends DuskTestCase
{
    // Connexion à l'application
    protected function login(Browser $browser)
    {
        $user = User::find(1);

        $browser->loginAs($user)
            ->visit('/') 
            ->assertPathIs('/'); 
    }
    
    public function testIndex()
    {
        $this->browse(function (Browser $browser) {
            $this->login($browser);

            $boat = Boat::first(); // Assurez-vous qu'il y a au moins un bateau dans la base de données
            $browser->visit("/editor/boats/{$boat->id}/edit")
                ->assertPathIs("/editor/boats/{$boat->id}/edit");
        });
    }

    public function testStore()
    {
        $this->browse(function (Browser $browser) {
            $this->login($browser);
            $boat = Boat::first(); // Assurez-vous qu'il y a au moins un bateau dans la base de données

            $initialDimensionCount = Dimension::count();
            $browser->visit("/editor/boats/{$boat->id}/dimensions/create")
                ->type('#weight_range', '500')
                ->type('#mold_number', '3')
                ->type('#length_cm', '200')
                ->type('#shape', 'Round')
                ->press('#store')
                ->assertPathIs("/editor/boats/{$boat->id}/edit"); 
            $newDimensionCount = Dimension::count();
            $this->assertEquals($initialDimensionCount + 1, $newDimensionCount, 'Une nouvelle dimension devrait être créée.');
        });
    }

    public function testEdit()
    {
        $this->browse(function (Browser $browser) {
            $this->login($browser);
            $boat = Boat::first(); // Assurez-vous qu'il y a au moins un bateau dans la base de données
            $dimension = $boat->dimensions[0]; // Assurez-vous qu'il y a au moins une dimension dans la base de données

            $browser->visit("/editor/boats/{$boat->id}/dimensions/{$dimension->id}/edit")
                    ->assertPathIs("/editor/boats/{$boat->id}/dimensions/{$dimension->id}/edit");
        });
    }

    public function testUpdate()
    {
        $this->browse(function (Browser $browser) {
            $this->login($browser);
            $boat = Boat::first(); // Assurez-vous qu'il y a au moins un bateau dans la base de données
            $dimension = $boat->dimensions[0]; // Assurez-vous qu'il y a au moins une dimension dans la base de données

            $browser->visit("/editor/boats/{$boat->id}/dimensions/{$dimension->id}/edit")
                    ->type('#weight_range', '600')
                    ->type('#mold_number', '4')
                    ->type('#length_cm', '250')
                    ->type('#shape', 'Square')
                    ->press('#update')
                    ->assertPathIs("/editor/boats/{$boat->id}/edit");

            $dimension->refresh();
            $this->assertEquals('600', $dimension->weight_range);
            $this->assertEquals('4', $dimension->mold_number);
            $this->assertEquals('250', $dimension->length_cm);
            $this->assertEquals('Square', $dimension->shape);
        });
    }

    public function testDestroy()
    {
        $this->browse(function (Browser $browser) {
            $this->login($browser);
            $boat = Boat::first(); // Assurez-vous qu'il y a au moins un bateau dans la base de données
            $dimension = $boat->dimensions[0]; // Assurez-vous qu'il y a au moins une dimension dans la base de données

            $initialDimensionCount = Dimension::count();

            $browser->visit("/editor/boats/{$boat->id}/edit")
                    ->press("#delete-{$dimension->id}")
                    ->acceptDialog()
                    ->assertPathIs("/editor/boats/{$boat->id}/edit"); 

            $newDimensionCount = Dimension::count();
            $this->assertEquals($initialDimensionCount - 1, $newDimensionCount, 'Une dimension devrait être supprimée.');
        });
    }
}
