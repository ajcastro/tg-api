<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\FourdGameEntry_4d3d2d;
use App\Models\FourdGameTransaction;

class FourdGameEntry4d3d2dFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = FourdGameEntry4d3d2d::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'fourd_game_transaction_id' => FourdGameTransaction::factory(),
            'num1' => $this->faker->randomDigitNotNull,
            'num2' => $this->faker->randomDigitNotNull,
            'num3' => $this->faker->randomDigitNotNull,
            'num4' => $this->faker->randomDigitNotNull,
            'game' => $this->faker->word,
            'bet' => $this->faker->randomFloat(2, 0, 9999999999999.99),
            'discount' => $this->faker->randomFloat(0, 0, 9999999999.),
            'pay' => $this->faker->randomFloat(2, 0, 9999999999999.99),
        ];
    }
}
