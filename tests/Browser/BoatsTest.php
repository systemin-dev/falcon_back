<?php

namespace Tests\Browser;

use App\Models\Boat;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class BoatsTest extends DuskTestCase

{
    // connexion à l'app
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

            $browser->visit('/editor/boats')
                ->assertPathIs('/editor/boats');
        });
    }

    public function testStore()
    {
        $this->browse(function (Browser $browser) {
            $this->login($browser);
            $initialBoatCount = Boat::count();
            $browser->visit('/editor/boats/create')
                ->select('#category', '1')
                ->attach('#image', __DIR__ . '/files/test-image.webp')
                ->select('#condition', 'new');
            foreach (config('app.langages') as $locale) {
                $browser->click("#{$locale}")
                    ->type("#description_{$locale}", "Description en {$locale}")
                    ->type("#base_{$locale}", "Base en {$locale}")
                    ->type("#construction_type_{$locale}", "Type de construction en {$locale}")
                    ->type("#flat_board_{$locale}", "Plat Bord en {$locale}");
            }
            $browser->press('#store')
                ->assertPathIs('/editor/boats/*/edit');
            $newBoatCount = \App\Models\Boat::count();
            $this->assertEquals($initialBoatCount + 1, $newBoatCount, 'Un nouveau bateau devrait être créé.');
        });
    }

    public function testEdit()
    {
        $this->browse(function (Browser $browser) {
            $this->login($browser);
            $boat = Boat::first(); // Assurez-vous qu'il y a au moins un bateau dans la base de données

            $browser->visit("/editor/boats/{$boat->id}/edit")
                ->assertPathIs("/editor/boats/{$boat->id}/edit");
        });
    }

    public function testUpdate()
    {
        $this->browse(function (Browser $browser) {
            $this->login($browser);
            $boat = Boat::first(); // Assurez-vous qu'il y a au moins un bateau dans la base de données

            $browser->visit("/editor/boats/{$boat->id}/edit")
                ->select('#category', '2')
                ->attach('#image', __DIR__ . '/files/test-image-updated.webp')
                ->select('#condition', 'used');
            foreach (config('app.langages') as $locale) {
                $browser->click("#{$locale}")
                    ->type("#description_{$locale}", "Description en {$locale}")
                    ->type("#base_{$locale}", "Base en {$locale}")
                    ->type("#construction_type_{$locale}", "Type de construction en {$locale}")
                    ->type("#flat_board_{$locale}", "Plat Bord en {$locale}");
            }
            $browser->press('#update')
                ->assertPathIs('/editor/boats');

            $boat->refresh();
            $this->assertEquals('2', $boat->category);
            $this->assertEquals('used', $boat->condition);
        });
    }

    public function testDestroy()
    {
        $this->browse(function (Browser $browser) {
            $this->login($browser);
            $boat = Boat::first();

            $initialBoatCount = Boat::count();

            $browser->visit("/editor/boats")
                ->press("#delete-{$boat->id}")
                ->acceptDialog()
                ->assertPathIs('/editor/boats');


            $newBoatCount = Boat::count();
            $this->assertEquals($initialBoatCount - 1, $newBoatCount, 'Un bateau devrait être supprimé.');
        });
    }
}
