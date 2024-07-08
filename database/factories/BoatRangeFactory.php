<?php

namespace Database\Factories;

use App\Models\BoatRange;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Boat;

class BoatRangeFactory extends Factory
{
    protected $model = BoatRange::class;

    public function definition()
    {
        return [
            'boat_id' => Boat::factory(),
            'name' => $this->faker->word,
            'weight' => $this->faker->numberBetween(1, 100),
        ];
    }
}
