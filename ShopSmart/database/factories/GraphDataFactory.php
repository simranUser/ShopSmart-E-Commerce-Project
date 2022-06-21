<?php

namespace Database\Factories;

use App\Models\GraphData;
use Illuminate\Database\Eloquent\Factories\Factory;

class GraphDataFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = GraphData::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->text(8),
            'description' => $this->faker->text,
            'views' => $this->faker->numberBetween(1, 10),
            'created_at' => $this->faker->unique()->dateTimeBetween('Mar 14 2020','Mar 14 2022'),

        ];
    }
}
