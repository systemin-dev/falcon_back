<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Create a specific user with a given email
        User::create([
            'name' => 'Équipe Falcon Racing',
            'role_id' => 1,
            'email' => 'admin@falconracing-europe.com', // Remplis ce champ avec l'adresse email souhaitée
            'password' => bcrypt('admin@falconracing-europe.com'), // Assure-toi de définir un mot de passe sécurisé
        ]);

        \App\Models\Setting::factory(1)->create();

        $this->call([
            TagSeeder::class,
            CategorySeeder::class,
            PostSeeder::class,
            BoatSeeder::class,
            OtherBoatSeeder::class,

        ]);
    }
}
