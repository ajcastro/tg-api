<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Rebate;
use App\Models\Website;

class RebateFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Rebate::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'website_id' => Website::factory(),
            'content' => $this->faker->paragraphs(3, true),
            'is_active' => $this->faker->boolean,
            'is_shown' => $this->faker->boolean,
        ];
    }
}
