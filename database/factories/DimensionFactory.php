<?php

namespace Database\Factories;

use App\Models\Dimension;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Boat;

class DimensionFactory extends Factory
{
    protected $model = Dimension::class;

    public function definition()
    {
        return [
            'boat_id' => Boat::factory(),
            'dimension' => $this->faker->word,
        ];
    }
}
