<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Game;
use App\Models\GameSetting;
use App\Models\Website;

class GameSettingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = GameSetting::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'website_id' => Website::factory(),
            'game_id' => Game::factory(),
            'min_bet' => $this->faker->numberBetween(-10000, 10000),
            'max_bet' => $this->faker->numberBetween(-10000, 10000),
            'win_multiplier' => $this->faker->randomFloat(0, 0, 9999999999.),
            'percentage_discount' => $this->faker->randomFloat(0, 0, 9999999999.),
            'percentage_kei' => $this->faker->randomFloat(0, 0, 9999999999.),
            'limit' => $this->faker->numberBetween(-10000, 10000),
            'limit_total' => $this->faker->numberBetween(-10000, 10000),
        ];
    }
}
