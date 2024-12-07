<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\FourdGame;
use App\Models\Market;
use App\Models\Website;

class FourdGameFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = FourdGame::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'market_id' => Market::factory(),
            'website_id' => Website::factory(),
            'date' => $this->faker->date(),
            'period' => $this->faker->randomNumber(),
            'num1' => $this->faker->randomDigitNotNull,
            'num2' => $this->faker->randomDigitNotNull,
            'num3' => $this->faker->randomDigitNotNull,
            'num4' => $this->faker->randomDigitNotNull,
        ];
    }
}
