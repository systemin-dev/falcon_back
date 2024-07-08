<?php

namespace Tests\Browser;

use App\Models\Boat;
use App\Models\BoatRange;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class BoatRangesTest extends DuskTestCase
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

            $initialRangeCount = BoatRange::count();
            $browser->visit("/editor/boats/{$boat->id}/ranges/create")
                ->type('#name', 'Nouvelle Gamme')
                ->type('#weight', '1000')
                ->press('Enregistrer')
                ->assertPathIs("/editor/boats/{$boat->id}/edit");
            
            $newRangeCount = BoatRange::count();
            $this->assertEquals($initialRangeCount + 1, $newRangeCount, 'Une nouvelle gamme devrait être créée.');
        });
    }

    public function testEdit()
    {
        $this->browse(function (Browser $browser) {
            $this->login($browser);
            $boat = Boat::first(); // Assurez-vous qu'il y a au moins un bateau dans la base de données
            $range = $boat->boatRanges->first(); // Assurez-vous qu'il y a au moins une gamme dans la base de données

            $browser->visit("/editor/boats/{$boat->id}/ranges/{$range->id}/edit")
                ->assertPathIs("/editor/boats/{$boat->id}/ranges/{$range->id}/edit");
        });
    }

    public function testUpdate()
    {
        $this->browse(function (Browser $browser) {
            $this->login($browser);
            $boat = Boat::first(); // Assurez-vous qu'il y a au moins un bateau dans la base de données
            $range = $boat->boatRanges->first(); // Assurez-vous qu'il y a au moins une gamme dans la base de données

            $browser->visit("/editor/boats/{$boat->id}/ranges/{$range->id}/edit")
                ->type('#name', 'Gamme Modifiée')
                ->type('#weight', '1500')
                ->press('Enregistrer')
                ->assertPathIs("/editor/boats/{$boat->id}/edit");

            $range->refresh();
            $this->assertEquals('Gamme Modifiée', $range->name);
            $this->assertEquals('1500', $range->weight);
        });
    }

    public function testDestroy()
    {
        $this->browse(function (Browser $browser) {
            $this->login($browser);
            $boat = Boat::first(); // Assurez-vous qu'il y a au moins un bateau dans la base de données
            $range = $boat->boatRanges->first(); // Assurez-vous qu'il y a au moins une gamme dans la base de données

            $initialRangeCount = BoatRange::count();

            $browser->visit("/editor/boats/{$boat->id}/edit")
                ->press("#delete-{$range->id}")
                ->acceptDialog()
                ->assertPathIs("/editor/boats/{$boat->id}/edit");

            $newRangeCount = BoatRange::count();
            $this->assertEquals($initialRangeCount - 1, $newRangeCount, 'Une gamme devrait être supprimée.');
        });
    }
}
