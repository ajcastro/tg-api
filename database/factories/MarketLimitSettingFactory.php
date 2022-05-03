<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Market;
use App\Models\MarketLimitSetting;
use App\Models\Website;

class MarketLimitSettingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = MarketLimitSetting::class;

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
            'limit_line_4d' => $this->faker->randomNumber(),
            'limit_line_3d' => $this->faker->randomNumber(),
            'limit_line_2d' => $this->faker->randomNumber(),
            'limit_line_2d_front' => $this->faker->randomNumber(),
            'limit_line_2d_middle' => $this->faker->randomNumber(),
        ];
    }
}
