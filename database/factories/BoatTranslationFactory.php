<?php

namespace Database\Factories;

use App\Models\BoatTranslation;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Boat;

class BoatTranslationFactory extends Factory
{
    protected $model = BoatTranslation::class;

    public function definition()
    {
        return [
            'boat_id' => Boat::factory(),
            'locale' => $this->faker->locale,
            'description' => $this->faker->sentence,
            'base' => $this->faker->word,
            'construction_type' => $this->faker->word,
            'flat_board' => $this->faker->word,
        ];
    }
}
