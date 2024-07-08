<?php

namespace Database\Factories;

use App\Models\Boat;
use Illuminate\Database\Eloquent\Factories\Factory;

class BoatFactory extends Factory
{
    protected $model = Boat::class;

    public function definition()
    {
        return [
            'category' => $this->faker->randomElement(['1', '2', '4', '8']),
            'image' => $this->faker->imageUrl(),
            'condition' => $this->faker->randomElement(['new', 'used']),
        ];
    }
}
