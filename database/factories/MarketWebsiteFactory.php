<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Market;
use App\Models\MarketWebsite;
use App\Models\User;
use App\Models\Website;

class MarketWebsiteFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = MarketWebsite::class;

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
            'period' => $this->faker->randomNumber(),
            'result_day' => collect(MarketWebsite::DAYS)->random(3)->all(),
            'off_day' => collect(MarketWebsite::DAYS)->random(3)->all(),
            'close_time' => $this->faker->time('H:i'),
            'result_time' => $this->faker->time('H:i'),
            'updated_by_id' => User::factory(),
        ];
    }
}
